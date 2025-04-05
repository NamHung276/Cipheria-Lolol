<?php
// Private Zone – only for authenticated users
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Optional: display user info
$username = $_SESSION['username'] ?? 'User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Private Zone</title>
    <link rel="stylesheet" href="loginstyle.css"> <!-- Or your main style -->
</head>
<body>
    <div class="private-container">
        <h2>Welcome, <?= htmlspecialchars($username) ?>!</h2>
        <p>You're in the private zone.</p>

        <div class="private-links">
            <a href="update_apply.php" class="btn">✏️ Update Your Info</a>
            <a href="delete_apply.php" class="btn delete">🗑️ Delete Your Account</a>
            <a href="logout.php" class="btn logout">🚪 Logout</a>
        </div>
    </div>
</body>
</html>