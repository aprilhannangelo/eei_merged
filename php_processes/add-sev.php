<?php
session_start();

$db = mysqli_connect("localhost", "root", "", "eei_db");

$desc = mysqli_real_escape_string($db, $_POST['desc']);
$lvl = mysqli_real_escape_string($db, $_POST['sevlvl']);
// $time = mysqli_real_escape_string($db, $_POST['sevtime']);




$query = "INSERT INTO severity_levels_t (severity_level, description) VALUES ('$lvl', '$desc')";
if (!mysqli_query($db, $query))
{
  die('Error' . mysqli_error($db));
}


header('Location: ../admin-settings.php');

?>
