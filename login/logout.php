<?php
session_start();

// Clear session variables
$_SESSION = array();

// Destroy session
session_destroy();

// Redirect to login page
header("Location: ../login/index.html");
exit();
?>
