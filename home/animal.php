<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "login_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$animal_id = $_GET['id'] ?? 0;

$sql = "SELECT * FROM animals WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $animal_id);
$stmt->execute();
$result = $stmt->get_result();
$animal = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($animal['name']) ?>'s Info</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>The Better Animal Association</h1>
        <nav>
          <a href="../home/">Home</a>
          <a href="../about/">About</a>
          <a href="../adopt/">Adopt</a>
          <a href="../login/">Employee Login</a>
        </nav>
    </header>

    <main>
        <?php if ($animal): ?>
            <h2><?= htmlspecialchars($animal['name']) ?></h2>
            <p><strong>Breed:</strong> <?= htmlspecialchars($animal['breed']) ?></p>
            <p><strong>Age:</strong> <?= htmlspecialchars($animal['age']) ?></p>
            <p><strong>Species:</strong> <?= htmlspecialchars($animal['species']) ?></p>
            <p><strong>Gender:</strong> <?= htmlspecialchars($animal['gender']) ?></p>
            <p><strong>Fixed:</strong> <?= htmlspecialchars($animal['fix']) ?></p>
            <p><strong>Description:</strong> <?= htmlspecialchars($animal['description']) ?></p>
            <p><strong>Fee:</strong> $<?= htmlspecialchars($animal['fee']) ?></p>
            <p><strong>Vaccinated?</strong> <?= htmlspecialchars($animal['vaccinated']) ?></p>
            <p><strong>Trained?</strong> <?= htmlspecialchars($animal['trained']) ?></p>


        <?php else: ?>
            <p>Animal not found.</p>
        <?php endif; ?>
    </main>

    <footer>
    <p>&copy; 2025 TBA - The Better Animal Association</p>
    </footer>
</body>
</html>
