<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
ob_start(); // Start output buffering
session_start();

require '../db_connect.php';

// Clear session variables
$_SESSION = array();

// Destroy session
session_destroy();

// Redirect to login page
header("Location: ../login/index.html");
exit();
?>
