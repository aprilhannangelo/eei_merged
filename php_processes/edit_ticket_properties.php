<?php
// include "../templates/dbconfig.php";
session_start();
$db = mysqli_connect("localhost", "root", "", "eei_db");

$status = mysqli_real_escape_string($db, $_POST['status']);
$category = mysqli_real_escape_string($db, $_POST['category']);
$id = mysqli_real_escape_string($db, $_POST['id']);
$severity= mysqli_real_escape_string($db,$_POST['severity']);

  $query1 = "UPDATE ticket_t SET ticket_status='$status', ticket_category='$category', severity_level='$severity' WHERE ticket_id = $id";
  if (!mysqli_query($db, $query1))
  {
    die('Error' . mysqli_error($db));
  }

mysqli_close($db);
?>
