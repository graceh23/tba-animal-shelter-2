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

// Assume this is from a form with POST method
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $username, $hashedPassword);
        if ($stmt->execute()) {
            echo "User registered successfully! Redirecting in 3 seconds...";
            header("refresh:3;url=../dashboard/index.html");            
        } else {
            echo "❌ Error: " . $stmt->error;
            header("refresh:3;url=../register/index.html");            
        }
    } else {
        echo "Prepare failed: " . $conn->error;
        header("refresh:3;url=../dashboard/index.html");            

    }
}
?>
