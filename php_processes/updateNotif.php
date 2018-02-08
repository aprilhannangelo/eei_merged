<?php
session_start();
$db = mysqli_connect("localhost", "root", "", "eei_db");
$id = $_POST['id'];

//id of cancelled is 9
$query = "UPDATE notification_t SET isRead = 1 WHERE notification_id = $id";

if (!mysqli_query($db, $query))
{
  die('Error' . mysqli_error($db));
}

$query2 = "SELECT ticket_id FROM notification_t WHERE notification_id = $id";
$result = mysqli_query($db, $query2);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

echo json_encode($row['ticket_id']);

mysqli_close($db);
?>
