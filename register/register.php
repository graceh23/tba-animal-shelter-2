//
<?php
session_start();

// Check if user is logged in and is an admin
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    // Not authorized, redirect to home or error page
    header("Location: ../login/login.php");
    exit;
}
?>

<!-- Register form only shown if user is admin -->
<h2>Register New User</h2>
<form action="process_register.php" method="POST">
    <input type="text" name="username" required placeholder="Username">
    <input type="password" name="password" required placeholder="Password">
    <select name="role">
        <option value="user">User</option>
        <option value="admin">Admin</option> <!-- Optional -->
    </select>
    <button type="submit">Register</button>
</form>

