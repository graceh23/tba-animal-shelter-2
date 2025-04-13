<?php
// delete_animal.php
$host = "localhost";
$user = "root";
$pass = "";
$db = "login_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "❌ No ID provided.";
    exit();
}

$stmt = $conn->prepare("DELETE FROM animals WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: ../manage-animals/");
    exit();
} else {
    echo "SQL Error: " . $stmt->error;
}
?>
