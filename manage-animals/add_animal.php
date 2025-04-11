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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $species = $_POST['species'];
    $age = $_POST['age'];
    $breed = $_POST['breed'];
    $gender = $_POST['gender'];
    $fix = $_POST['fix'];
    $desc = $_POST['desc'];
    $fee = $_POST['fee'];

    // Insert into database without image
    $stmt = $conn->prepare("INSERT INTO animals (name, species, age, breed, gender, fix, description, fee, available) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1)");
    $stmt->bind_param("ssisssss", $name, $species, $age, $breed, $gender, $fix, $desc, $fee);

    if ($stmt->execute()) {
        echo "Animal Added! Redirecting in 3 seconds...";
        header("refresh:3;url=../manage-animals/index.html");          
        exit();
    } else {
        echo "❌ SQL Error: " . $stmt->error;
    }
}
?>
