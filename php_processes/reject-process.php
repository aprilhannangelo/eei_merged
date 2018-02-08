<?php
// include "../templates/dbconfig.php";
session_start();
$db = mysqli_connect("localhost", "root", "", "eei_db");


$ticketID = mysqli_real_escape_string($db, $_POST['ticketID']);
// $request_details = mysqli_real_escape_string($db, $_POST['request_details']);


$query = "UPDATE ticket_t SET ticket_status = '5' WHERE ticket_id= $ticketID";

if (!mysqli_query($db, $query))
{
  die('Error' . mysqli_error($db));
}



mysqli_close($db);
?>
