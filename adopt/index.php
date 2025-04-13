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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Adopt an Animal | TBA</title>
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
    <section class="adopt-form-section">
        <h2>Adoption Application</h2>
        <form action="submit_adoption.php" method="POST" class="adopt-form">
  <label for="first_name">First Name:</label>
  <input type="text" id="first_name" name="first_name" required />

  <label for="last_name">Last Name:</label>
  <input type="text" id="last_name" name="last_name" required />

  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required />

  <label for="phone">Phone:</label>
  <input type="text" id="phone" name="phone" required />

  <label for="animal_name">Which animal would you like to adopt?</label>
<select name="animal_name" id="animal_name" required>
  <?php
    // Fetch names of available animals
    $conn = new mysqli("localhost", "root", "", "login_db");
    $result = $conn->query("SELECT name FROM animals WHERE available = 1");
    while ($row = $result->fetch_assoc()) {
      echo "<option value='" . htmlspecialchars($row['name']) . "'>" . htmlspecialchars($row['name']) . "</option>";
    }
  ?>
</select>


  <label>Housing Type:</label>
<label><input type="radio" name="housing_type" value="Rent" required /> Rent</label>
<label><input type="radio" name="housing_type" value="Own" required /> Own</label>


  <label for="reason">Why do you want to adopt?</label>
  <textarea id="reason" name="reason" required></textarea>

  <label>
    <input type="checkbox" name="agree_to_terms" value="1" required />
    I agree to care for the animal to the best of my ability.
  </label>

  <button type="submit">Submit Application</button>
</form>

    </section>
  </main>

  <footer>
    <p>&copy; 2025 TBA - The Better Animal Association</p>
  </footer>
</body>
</html>