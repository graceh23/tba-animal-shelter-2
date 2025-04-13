<?php
// Connect to database
$host = "localhost";
$user = "root";
$pass = "";
$db = "login_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$filter = $_GET['filter'] ?? '';

if ($filter) {
    $sql = "SELECT id, name, breed, age FROM animals WHERE available = 1 AND species = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $filter);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT id, name, breed, age FROM animals WHERE available = 1";
    $result = $conn->query($sql);
}

//$sql = "SELECT id, name, breed, age FROM animals WHERE available = 1";
//$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> TBA - The Better Animal Association</title>
    <link rel="stylesheet" href="../css/style.css" />
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
        <h1>Welcome to TBA!</h1>
        <p>The Better Animal Association is dedicated to caring for and helping animals in need.</p>
        <br>
        <section class="home-img">
            <img src="../images/home.jpg" class="home-img" />
        </section>
<br>
        <h2>Meet Our Animals!</h2>

        <section class="filters" id="filters">
    <a href="index.php"><button>All</button></a>
    <a href="index.php?filter=Cat"><button>Cats</button></a>
    <a href="index.php?filter=Dog"><button>Dogs</button></a>
    <a href="index.php?filter=Other"><button>Other</button></a>
    <br>
    <br>
</section>


        <section class="animal-list" id="animal-list">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="animal-card">
                        <h3><?= htmlspecialchars($row['name']) ?></h3>
                        <p>Breed: <?= htmlspecialchars($row['breed']) ?></p>
                        <p>Age: <?= htmlspecialchars($row['age']) ?></p>
                        <a href="animal.php?id=<?= $row['id'] ?>">View Details</a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No animals available at the moment.</p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 TBA - The Better Animal Association</p>
    </footer>
</body>
</html>
