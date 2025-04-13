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

// Handle accept/deny actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $id = $_POST['form_id'];
    $action = $_POST['action'];

    if ($action === 'accept') {
        $status = 'Accepted';
    } elseif ($action === 'deny') {
        $status = 'Denied';
    }

    $stmt = $conn->prepare("UPDATE adoption_forms SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
}

// Get filter value from query string (default to Pending)
$filter = isset($_GET['status']) ? $_GET['status'] : 'Pending';

$stmt = $conn->prepare("SELECT * FROM adoption_forms WHERE status = ? OR (status IS NULL AND ? = 'Pending') ORDER BY id DESC");
$stmt->bind_param("ss", $filter, $filter);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Review Adoption Forms</title>
  <link rel="stylesheet" href="../css/style.css" />
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
    }
    th, td {
      padding: 0.75rem;
      border: 1px solid #ccc;
      text-align: left;
    }
    th {
      background-color: #f5f5f5;
    }
    .filter-form {
      margin-bottom: 1rem;
    }
  </style>
</head>
<body>
  <header>
    <h1>Employee Dashboard - Adoption Review</h1>
    <nav>
      <a href="../dashboard/index.html">Dashboard</a>
      <a href="../dashboard/">Back to Dashboard</a>
      <a href="../logout/logout.php">Logout</a>
    </nav>
  </header>

  <main class="view-submissions">
    <h2>Adoption Submissions</h2>

    <form class="filter-form" method="GET">
      <label for="status">Filter by Status:</label>
      <select name="status" id="status" onchange="this.form.submit()">
        <option value="Pending" <?= $filter === 'Pending' ? 'selected' : '' ?>>Pending</option>
        <option value="Accepted" <?= $filter === 'Accepted' ? 'selected' : '' ?>>Accepted</option>
        <option value="Denied" <?= $filter === 'Denied' ? 'selected' : '' ?>>Denied</option>
      </select>
    </form>

    <?php if ($result->num_rows > 0): ?>
      <table>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Animal</th>
          <th>Housing</th>
          <th>Reason</th>
          <th>Agreement</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td><?= htmlspecialchars($row['animal_name']) ?></td>
            <td><?= htmlspecialchars($row['housing_type']) ?></td>
            <td><?= nl2br(htmlspecialchars($row['reason'])) ?></td>
            <td><?= in_array(strtolower($row['agreement']), ['1', 'yes', 'on', 'true']) ? '✔️' : '✔️' ?></td>            <td><?= $row['status'] ?? 'Pending' ?></td>
            <td class="action-buttons">
              <?php if (empty($row['status']) || $row['status'] === 'Pending'): ?>
                <form method="POST" style="display:inline;">
                  <input type="hidden" name="form_id" value="<?= $row['id'] ?>">
                  <input type="hidden" name="action" value="accept">
                  <button class="accept-btn" type="submit">Accept</button>
                </form>
                <form method="POST" style="display:inline;">
                  <input type="hidden" name="form_id" value="<?= $row['id'] ?>">
                  <input type="hidden" name="action" value="deny">
                  <button class="deny-btn" type="submit">Deny</button>
                </form>
              <?php else: ?>
                <em>No actions available</em>
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; ?>
      </table>
    <?php else: ?>
      <p>No adoption submissions found for this filter.</p>
    <?php endif; ?>
  </main>

  <footer>
    <p>&copy; 2025 TBA - The Better Animal Association</p>
  </footer>
</body>
</html>
