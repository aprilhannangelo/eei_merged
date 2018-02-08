<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/Applications/XAMPP/xamppfiles/htdocs/eei-hanney/PHPMailer-master/src/Exception.php';
require '/Applications/XAMPP/xamppfiles/htdocs/eei-hanney/PHPMailer-master/src/PHPMailer.php';
require '/Applications/XAMPP/xamppfiles/htdocs/eei-hanney/PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    //Server settings$mail->
		$mail->SMTPDebug = 2;
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = "smtp.gmail.com";  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = "dondumaliang@gmail.com";                 // SMTP username
    $mail->Password = "tritondrive";                           // SMTP password
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom("dondumaliang@gmail.com", "Donna Dumaliang");
    $mail->addAddress("dondumaliang@gmail.com", "Donna Dumaliang");     // Add a recipient
    $mail->addReplyTo("dondumaliang@gmail.com", "Donna Dumaliang");

    //Attachments

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "Access Request for Review";
		$mail->Body = " is requesting for "  . " access" . "<br> The Request has already been checked, kindly view and approve access request details through the EEI Service Desk website http://localhost/eei-master/details.php?id=" ;
    $mail->send();
 ?>
