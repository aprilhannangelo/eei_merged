<?php
// include "../templates/dbconfig.php";
session_start();
$db = mysqli_connect("localhost", "root", "", "eei_db");

$request_title = mysqli_real_escape_string($db, $_POST['title']);
$request_details = mysqli_real_escape_string($db, $_POST['request_details']);

//INSERT TO TICKET_T
$query1 = "INSERT INTO ticket_t (ticket_id, ticket_title, ticket_type, ticket_status, date_prepared, user_id) VALUES(DEFAULT, '$request_title', 'Service', '1', NOW(), '{$_SESSION['user_id']}')";
if (!mysqli_query($db, $query1))
{
  die('Error' . mysqli_error($db));
}

//get id of latest row inserted
$latest_id = mysqli_insert_id($db);


//UPDATE TICKET_NUMBER since form should be submitted first para may id na icoconcat
$query2 = "UPDATE ticket_t SET ticket_number= CONCAT(EXTRACT(YEAR FROM date_prepared), ticket_id)  WHERE ticket_id = '$latest_id'";
if (!mysqli_query($db, $query2))
{
  die('Error' . mysqli_error($db));
}

//INSERT to service_ticket_t
$query3 = "INSERT INTO service_ticket_t (ticket_id, request_details) VALUES('$latest_id', '$request_details')";
if (!mysqli_query($db, $query3))
{
  die('Error' . mysqli_error($db));
}


//for swal ticket number display
$query4 = "SELECT ticket_number from ticket_t where ticket_id = '$latest_id'";

$result = mysqli_query($db, $query4);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

echo json_encode($row['ticket_number']);
//else{
//   // header("Location: ..\home.php");
// }

// if(mysqli_query($db, $query1)){
//   echo "Record added successfully.";
//   header("Location: ..\home.php");
// } else{
//   echo "ERROR: could not execute $query." . mysqli_error($db);
//
// }
//nav notification
$sql = "SELECT user_id from user_t where user_type= 'Administrator'";
$result2= mysqli_query($db, $sql);
$row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
$adminId = $row2['user_id'];

$notifSql = "INSERT INTO notification_t (notification_id,ticket_id, user_id, notification_description, isRead) VALUES(DEFAULT, '$latest_id','$adminId','Ticket No. : $row[ticket_number] needs your review',0)";
if (!mysqli_query($db, $notifSql))
{
  die('Error' . mysqli_error($db));
}
mysqli_close($db);
?>
