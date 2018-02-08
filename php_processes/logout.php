<?php
session_start();
session_destroy();
header('location: \eei\index.php');
exit;
?>
