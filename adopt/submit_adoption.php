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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first = $_POST['first_name'];
    $last = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $animal_name = $_POST['animal_name'];
    $housing = $_POST['housing_type'];
    $reason = $_POST['reason'];
    $agree = isset($_POST['agree_to_terms']) ? 1 : 0;

    $stmt = $conn->prepare("INSERT INTO adoption_forms 
        (first_name, last_name, email, phone, animal_name, housing_type, reason, agree_to_terms) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssi", $first, $last, $email, $phone, $animal_name, $housing, $reason, $agree);

    if ($stmt->execute()) {
        header("refresh:0;url=../adopt/adopt_submitted.php");          
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
