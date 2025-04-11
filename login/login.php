<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "login_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    // Check password
    if (password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        header("Location: ../dashboard/index.html");
        exit();
    } else {
        echo "Incorrect password.";
        header("Location: ../login/index.html");
    }
} else {
    echo "User not found.";
    header("Location: ../login/index.html");
}



?>
