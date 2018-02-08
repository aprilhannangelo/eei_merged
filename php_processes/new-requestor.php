<?php
// include "../templates/dbconfig.php";
session_start();

//mailer start
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/Applications/XAMPP/xamppfiles/htdocs/eei-final/PHPMailer-master/src/Exception.php';
require '/Applications/XAMPP/xamppfiles/htdocs/eei-final/PHPMailer-master/src/PHPMailer.php';
require '/Applications/XAMPP/xamppfiles/htdocs/eei-final/PHPMailer-master/src/SMTP.php';
$db = mysqli_connect("localhost", "root", "", "eei_db");


$userid = mysqli_real_escape_string($db, $_POST['userid']);
$fname = mysqli_real_escape_string($db, $_POST['fname']);
$lname = mysqli_real_escape_string($db, $_POST['lname']);
$password = mysqli_real_escape_string($db, $_POST['password']);
$email = mysqli_real_escape_string($db, $_POST['email']);
$type = mysqli_real_escape_string($db, $_POST['type']);
$name = $fname . " " . $lname;
// $request_details = mysqli_real_escape_string($db, $_POST['request_details']);
$latest_id = mysqli_insert_id($db);

$query = "INSERT INTO user_t (user_id,userid,first_name,last_name,password,email_address,user_type) VALUES (DEFAULT,'$userid','$fname','$lname',MD5('$password'),'$email','$type')";

if (!mysqli_query($db, $query))
{
  die('Error' . mysqli_error($db));
}

$errorMsg = mysqli_error($db);
$latest_id = mysqli_insert_id($db);

$query4 = "SELECT CONCAT(first_name, ' ', last_name) as requestor_name from user_t where user_id = '$latest_id'";

$result = mysqli_query($db, $query4);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

echo json_encode($row['requestor_name']);
// if(mysqli_query($db, $query1)){
//   echo "Record added successfully.";
//   header("Location: ..\home.php");
// } else{
//   echo "ERROR: could not execute $query." . mysqli_error($db);
//
// }

//mailer script
$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    //Server settings$mail->

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = "smtp.gmail.com";  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = "dondumaliang@gmail.com";                 // SMTP username
    $mail->Password = "tritondrive";                           // SMTP password
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom("dondumaliang@gmail.com", "Donna Dumaliang");
    $mail->addAddress($email,$name);     // Add a recipient
    $mail->addReplyTo("dondumaliang@gmail.com", "Donna Dumaliang");

    //Attachments

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "EEI Service Desk User Details";
		$mail->Body = "You have been granted access to the EEI Service Desk Application. The following are your login credentials: <br> Username: " . $userid . "<br> Password: usr@EEI1" ;
    $mail->send();


mysqli_close($db);
?>
