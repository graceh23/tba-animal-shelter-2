<?php
// edit_animal.php
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
    echo "❌ No animal ID provided.";
    exit();
}

// Handle form submission
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

    $stmt = $conn->prepare("UPDATE animals SET (name=?, species=?, age=?, breed=?, gender=?, fix=?, description=?, fee=?, vaccinated=?, trained=?, special=?, WHERE id=?");
    $stmt->bind_param("ssissssssss", $name, $species, $age, $breed, $gender, $fix, $description, $fee, $vaccinated, $trained, $special);
    
    if ($stmt->execute()) {
        echo "Animal deleted! Redirecting in 3...";
        header("refresh:3;url=../manage-animals/");
        exit();
    } else {
        echo "SQL Error: " . $stmt->error;
    }
}

// Get existing animal info
$stmt = $conn->prepare("SELECT * FROM animals WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$animal = $result->fetch_assoc();

if (!$animal) {
    echo "Animal not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Animal | TBA</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
  <h2>Edit Animal: <?= htmlspecialchars($animal['name']) ?></h2>
  <form method="POST">
    <label>Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($animal['name']) ?>" required />

    <label>Species:</label>
    <input type="text" name="species" value="<?= htmlspecialchars($animal['species']) ?>" required />

    <label>Age:</label>
    <input type="number" name="age" value="<?= $animal['age'] ?>" required />

    <label>Breed:</label>
    <input type="text" name="breed" value="<?= htmlspecialchars($animal['breed']) ?>" required />

    <label>Gender:</label>
    <select name="gender" required>
      <option value="Male" <?= $animal['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
      <option value="Female" <?= $animal['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
    </select>

    <label>Spayed/Neutered:</label>
    <select name="fix" required>
      <option value="Yes" <?= $animal['fix'] == 'Yes' ? 'selected' : '' ?>>Yes</option>
      <option value="No" <?= $animal['fix'] == 'No' ? 'selected' : '' ?>>No</option>
    </select>

    <label>Vaccinated? </label>
    <select name="trained" required>
      <option value="Yes" <?= $animal['vaccinated'] == 'Yes' ? 'selected' : '' ?>>Yes</option>
      <option value="No" <?= $animal['vaccinated'] == 'No' ? 'selected' : '' ?>>No</option>
    </select>

    <label>Trained? </label>
    <select name="trained" required>
      <option value="Yes" <?= $animal['trained'] == 'Yes' ? 'selected' : '' ?>>Yes</option>
      <option value="No" <?= $animal['trained'] == 'No' ? 'selected' : '' ?>>No</option>
    </select>

    <label>Health Concerns? </label>
    <select name="special" required>
      <option value="Yes" <?= $animal['special'] == 'Yes' ? 'selected' : '' ?>>Yes</option>
      <option value="No" <?= $animal['special'] == 'No' ? 'selected' : '' ?>>No</option>
    </select>

    <label>Description:</label>
    <textarea name="desc" required><?= htmlspecialchars($animal['description']) ?></textarea>

    <label>Fee:</label>
    <input type="text" name="fee" value="<?= htmlspecialchars($animal['fee']) ?>" required />

    <button type="submit">Update Animal</button>
  </form>
</body>
</html>
