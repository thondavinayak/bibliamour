<?php
if (!isset($_SESSION['user'])) {
    $_SESSION["message"] = "Please Login to your Account";
    $_SESSION["message_type"] = "danger";
    header("location:connection.php");
    exit();
}

define('ROLE_ADMIN', 0);
define('ROLE_USER', 1);

if ($_SESSION['user']['role'] != ROLE_ADMIN) {
    $_SESSION["message"] = "Sorry, you do not have access.";
    $_SESSION["message_type"] = "danger";
    header("location:dashboard.php"); 
    exit();
}
?>
