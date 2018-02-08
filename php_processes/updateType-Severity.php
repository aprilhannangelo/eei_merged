<?php
// include "../templates/dbconfig.php";
session_start();
$db = mysqli_connect("localhost", "root", "", "eei_db");

$category = mysqli_real_escape_string($db, $_POST['category']);
$id = mysqli_real_escape_string($db, $_POST['id']);
$severity= mysqli_real_escape_string($db,$_POST['severity']);


$query = "UPDATE ticket_t SET ticket_category='$category', severity_level='$severity', ticket_status='5' WHERE ticket_id = $id";
if (!mysqli_query($db, $query))
{
  die('Error' . mysqli_error($db));
}


$result = mysqli_query($db, $query);
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

//date required
$datePrepared = "SELECT date_prepared FROM ticket_t WHERE ticket_id = $id";
$row4 =mysqli_fetch_array(mysqli_query($db, $datePrepared),MYSQLI_ASSOC);
$datePrepared = $row4['date_prepared'];
$date = $datePrepared;

$sql = "SELECT resolution_time FROM sla_t WHERE id = '$severity'";
$row3 = mysqli_fetch_array(mysqli_query($db, $sql),MYSQLI_ASSOC);
$interval = $row3['resolution_time'];

$dateRequired = "UPDATE ticket_t set date_required = DATE_ADD('$date', INTERVAL $interval  HOUR) WHERE ticket_id = $id";
$run = mysqli_query($db, $dateRequired);

if ($category=='Technicals') {
    $query3 = "SELECT user_id from user_t where user_type = 'Technicals Group Manager'";
    $result = mysqli_query($db, $query3);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    $mgrId= $row['user_id'];
    $query2 = "UPDATE ticket_t SET it_group_manager_id= '$mgrId'   ,  date_assigned = NOW() WHERE ticket_id = $id";
    $row2=mysqli_query($db, $query2);
}
elseif ($category=='Access') {
  $query3 = "SELECT user_id from user_t where user_type = 'Access Group Manager'";
  $result = mysqli_query($db, $query3);
  $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
  $mgrId= $row['user_id'];
  $query2 = "UPDATE ticket_t SET it_group_manager_id= '$mgrId'  ,  date_assigned = NOW() WHERE ticket_id = $id";
  $row2=mysqli_query($db, $query2);
}
elseif ($category=='Network') {
  $query3 = "SELECT user_id from user_t where user_type = 'Network Group Manager'";
  $result = mysqli_query($db, $query3);
  $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
  $mgrId= $row['user_id'];
  $query2 = "UPDATE ticket_t SET it_group_manager_id= '$mgrId' , date_assigned = NOW() WHERE ticket_id = $id";
  $row2=mysqli_query($db, $query2);
}

//date required
$dateAssigned = "SELECT date_assigned FROM ticket_t WHERE ticket_id = $id";
$row4 =mysqli_fetch_array(mysqli_query($db, $dateAssigned),MYSQLI_ASSOC);
$dateAssigned = $row4['date_assigned'];
$date = $dateAssigned;

$sql = "SELECT resolution_time FROM sla_t WHERE id = '$severity'";
$row3 = mysqli_fetch_array(mysqli_query($db, $sql),MYSQLI_ASSOC);
$interval = $row3['resolution_time'];

$dateRequired = "UPDATE ticket_t set date_required = DATE_ADD('$date', INTERVAL $interval  HOUR) WHERE ticket_id = $id";
$run = mysqli_query($db, $dateRequired);


//notif table
$sql = "SELECT ticket_number from ticket_t WHERE ticket_id = $id";
$row3=mysqli_fetch_array(mysqli_query($db, $sql),MYSQLI_ASSOC);
$ticketNo = $row3['ticket_number'];
$notifSql = "INSERT INTO notification_t (notification_id,ticket_id, user_id, notification_description, isRead) VALUES(DEFAULT, $id,'$mgrId','$ticketNo has been assigned to you',0)";

if (!mysqli_query($db, $notifSql))
{
  die('Error' . mysqli_error($db));
}


//for swal Display
// $query4 = "SELECT ticket_category, severity_level FROM ticket_t WHERE ticket_id = $id";
//
// $result = mysqli_query($db, $query4);
// $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
//
// echo json_encode($row['ticket_category']);
// echo json_encode($row['severity_level']);


mysqli_close($db);
?>
