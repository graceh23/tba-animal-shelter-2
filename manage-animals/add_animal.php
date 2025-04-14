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
    $age = intval($_POST['age']);
    $breed = $_POST['breed'];
    $gender = $_POST['gender'];
    $fix = $_POST['fix'];
    $description = $_POST['desc'];
    $fee = $_POST['fee'];
    $vaccinated = $_POST['vaccinated'];
    $trained = $_POST['trained'];
    $special = $_POST ['special'];

    $stmt = $conn->prepare("INSERT INTO animals (name, species, age, breed, gender, fix, description, fee, vaccinated, trained, special) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssissssssss", $name, $species, $age, $breed, $gender, $fix, $description, $fee, $vaccinated, $trained, $special,);

    if ($stmt->execute()) {
        echo "Animal Added! Redirecting in 3 seconds...";
        header("refresh:3;url=../manage-animals/");
        exit();
    } else {
        echo "SQL Error: " . $stmt->error;
    }
}
?>
