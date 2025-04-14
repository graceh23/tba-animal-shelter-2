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
    $special = $_POST['special'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manage Animals | TBA</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
    <header>
        <h1>Welcome, Employee!</h1>
        <nav>
          <a href="../home/">Home</a>
          <a href="../dashboard/">Back to Dashboard</a>
          <a href="../login/logout.php">Log Out</a>
        </nav>
    </header>

  <main>
    <section class="manage-animals-section">
      <h2>Add New Animal</h2>
      <form id="add-animal-form" class="manage-form" action="add_animal.php" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required />

        <label for="species">Species:</label>
        <input type="text" name="species" id="species" required />

        <label for="age">Age:</label>
        <input type="number" name="age" id="age" required />

        <label for="breed">Breed:</label>
        <input type="text" name="breed" id="breed" required />

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
          <option value="Female">Female</option>
          <option value="Male">Male</option>
       </select>

       <label for ="fix">Spayed or Neutered?</label>
       <select id="fix" name="fix" required>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
       </select>

        <label for="desc">Description:</label>
        <textarea name="desc" id="desc" required></textarea>

        <label for="vaccinated">Vaccinated:</label>
        <select name="vaccinated" id="vaccinated">
        <option value="Yes">Yes</option>
        <option value="No">No</option>
        </select>

        <label for="trained">Trained:</label>
        <select name="trained" id="trained">
        <option value="Yes">Yes</option>
        <option value="No">No</option>
        </select>

        <label for="special">Health Concerns? (Describe in Description):</label>
        <select name="special" id="special">
        <option value="Yes">Yes</option>
        <option value="No">No</option>
        </select>

        <label for="fee">Fee:</label>
        <input type="text" name="fee" id="fee" required />

        <!-- Image Upload Field -->
        <label for="image">Upload Image:</label>
        <input type="file" name="image" id="image" accept="image/*" />

        <button type="submit">Add Animal</button>
      </form>


      <h2>Current Animals</h2>
      <ul id="animal-list">
      <?php
$sql = "SELECT * FROM animals ORDER BY id DESC"; // Optional: order by latest
$result = $conn->query($sql);

if ($result && $result->num_rows > 0): ?>
  <ul id="animal-list">
    <?php while ($row = $result->fetch_assoc()): ?>
      <li>
        <strong><?= htmlspecialchars($row['name']) ?></strong><br>
        Species: <?= htmlspecialchars($row['species']) ?><br>
        Age: <?= htmlspecialchars($row['age']) ?><br>
        Breed: <?= htmlspecialchars($row['breed']) ?><br>
        <a href="edit_animal.php?id=<?= $row['id'] ?>">Edit</a>
        <a href="delete_animal.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
      </li>
    <?php endwhile; ?>
  </ul>
<?php else: ?>
  <p>No animals found.</p>
<?php endif; ?>

      </ul>
    </section>
  </main>
      </ul>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 TBA - The Better Animal Association</p>
  </footer>
</body>
</html>

