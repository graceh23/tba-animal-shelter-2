<?php
// Connect to the database
$host = "localhost";     // or your server IP
$user = "root";          // your MySQL username
$pass = "";              // your MySQL password
$db = "login_db";        // your database name

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>