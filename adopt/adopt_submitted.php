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
    <section class="about">
        <h1> Adoption Form Submitted!</h1>
        <p>
        <class="thank-you">
        <h2>Thank You for Your Application! 🐾</h2>
        <p>We’ve received your adoption form and our team will review it shortly.</p>
        <p>You’ll be contacted soon with the next steps. In the meantime, thank you for supporting animal rescue!</p>
        <a href="../home/" class="button">Back to Home</a>
        <img src="../images/adopt_submit.jpg" class="about-img">
    </section>
    </main>


  <footer>
    <p>&copy; 2025 TBA - The Better Animal Association</p>
  </footer>
</body>
</html>