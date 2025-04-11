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
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> TBA - The Better Animal Association</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
    <header>
        <h1>The Better Animal Association</h1>
        <nav>
          <a href="../index/index.html">Home</a>
          <a href="../about/index.html">About</a>
          <a href="../adopt/index.html">Adopt</a>
          <a href="../login/index.html">Employee Login</a>
        </nav>
    </header>

    <main>
        <h1> Welcome to TBA!</h1>
        <p> TBA is dedicated to caring for and helping animals in need.</p>

        <br>
        
        <section class="home-img">
            
            <img src="../images/home.jpg" class="home-img" />
        </section>
        <br>

        <br>
        <h2>Meet Our Animals!</h2>

        <section class="filters" id="filters">
            <!-- Not working yet -->
            <button>All</button>
            <button>Cats</button>
            <button>Dogs</button>
            <button>Special Needs</button>
            <button>Other</button>
        </section>

        <br>

        <section class="animal-list" id="animal-list">
            <!-- Animal list will be populated dynamically from database-->
             
        </section>
    </main>

    <footer>
        <p>&copy; 2025 TBA - The Better Animal Association</p>
    </footer>

</body>
</html>
