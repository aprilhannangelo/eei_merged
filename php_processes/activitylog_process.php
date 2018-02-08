<?php
session_start();
$db = mysqli_connect("localhost", "root", "", "eei_db");
// $name = $_REQUEST['name'];

$logger = $_SESSION['user_id'];
$comments = mysqli_real_escape_string($db, $_POST['comments']);
$ticketID = mysqli_real_escape_string($db, $_POST['ticketID']);



mysqli_query($db, "INSERT INTO activity_log_t(activity_log_details, logger, ticket_id) VALUES('$comments', '$logger', '$ticketID')");

$result = mysqli_query($db, "SELECT * FROM activity_log_t ORDER BY activity_log_id DESC");
while($row=mysqli_fetch_array($result)){
echo "<div class='comments_content'>";
echo "<h6>" . $row['activity_log_details'] . "</h6>";
echo "</div>";
}
mysqli_close($db);
?>
