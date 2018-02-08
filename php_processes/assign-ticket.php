<?php
// include "../templates/dbconfig.php";
session_start();
$db = mysqli_connect("localhost", "root", "", "eei_db");

$a = mysqli_real_escape_string($db, $_POST['assignee']);
$id = mysqli_real_escape_string($db, $_POST['id']);
$logger = $_SESSION['user_id'];
$ticketID = mysqli_real_escape_string($db, $_POST['ticketID']);


$query = "UPDATE ticket_t SET ticket_agent_id = '$a' WHERE ticket_id = $id";
if (!mysqli_query($db, $query))
{
  die('Error' . mysqli_error($db));
}
//get ticket agent name for activity log
$assignee = "SELECT CONCAT(r.first_name, ' ', r.last_name) AS assignee FROM user_t r LEFT JOIN ticket_t t on r.user_id=t.ticket_agent_id WHERE ticket_id = $id";
$result = mysqli_query($db, $assignee);
while($row = mysqli_fetch_assoc($result)){
  $tagent= $row['assignee'];
}



//for swal ticket number display
$query2 = "SELECT CONCAT(r.first_name, ' ', r.last_name) AS assignee FROM user_t r LEFT JOIN ticket_t t on r.user_id=t.ticket_agent_id WHERE ticket_id = $id";

$result = mysqli_query($db, $query2);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

echo json_encode($row['assignee']);

// not working yet
$query3 = "INSERT INTO activity_log_t(logger, ticket_no, activity_log_details) VALUES('$logger', '$ticketID', 'Ticket assigned to $tagent')";
if (!mysqli_query($db, $query3))
{
  die('Error' . mysqli_error($db));
}
//notif table
$sql = "SELECT ticket_number from ticket_t WHERE ticket_id = $id";
$row3=mysqli_fetch_array(mysqli_query($db, $sql),MYSQLI_ASSOC);
$ticketNo = $row3['ticket_number'];
$notifSql = "INSERT INTO notification_t (notification_id,ticket_id, user_id, notification_description, isRead) VALUES(DEFAULT, $id,'$a','$ticketNo has been assigned to you',0)";

if (!mysqli_query($db, $notifSql))
{
  die('Error' . mysqli_error($db));
}



mysqli_close($db);
?>
