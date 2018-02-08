<?php
session_start();
$db = mysqli_connect("localhost", "root", "", "eei_db");
$ticketID = mysqli_real_escape_string($db, $_POST['ticketID']);

//id of cancelled is 9
$query = "UPDATE ticket_t SET ticket_status = '9' WHERE ticket_id = $ticketID";

if (!mysqli_query($db, $query))
{
  die('Error' . mysqli_error($db));
}
mysqli_close($db);
?>
