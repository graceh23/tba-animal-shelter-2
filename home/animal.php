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
            <section class="animal-profile">
            <img src="../images/cat.jpg" class="animal-image">
            <div class="animal-info">
            <h2><?= htmlspecialchars($animal['name']) ?></h2>
            <ul>
                <li><strong>Breed:</strong> <?= htmlspecialchars($animal['breed']) ?></li>
                <li><strong>Age:</strong> <?= htmlspecialchars($animal['age']) ?></li>
                <li><strong>Species:</strong> <?= htmlspecialchars($animal['species']) ?></li>
                <li><strong>Gender:</strong> <?= htmlspecialchars($animal['gender']) ?></li>
                <li><strong>Fixed:</strong> <?= htmlspecialchars($animal['fix']) ?></li>
                <li><strong>Description:</strong> <?= htmlspecialchars($animal['description']) ?></li>
                <li><strong>Fee:</strong> $<?= htmlspecialchars($animal['fee']) ?></li>
                <li><strong>Vaccinated?</strong> <?= htmlspecialchars($animal['vaccinated']) ?></li>
                <li><strong>Trained?</strong> <?= htmlspecialchars($animal['trained']) ?></li>
                <li><strong>Health Concerns?</strong> <?= htmlspecialchars($animal['special']) ?></li>
            </ul>
            </div>
            </section>
            <a href="../adopt/" class="adopt-button"> Adopt!</a>
            

        <?php else: ?>
            <p>Animal not found.</p>
        <?php endif; ?>
    </main>

    <footer>
    <p>&copy; 2025 TBA - The Better Animal Association</p>
    </footer>
</body>
</html>
