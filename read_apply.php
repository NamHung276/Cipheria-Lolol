<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'settings.php';

// Fetch all applications
$sql = "SELECT * FROM applications ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Applications</title>
    <link rel="stylesheet" href="adminstyle.css"> <!-- Optional styling -->
</head>
<body>
    <h1>Submitted Applications</h1>

    <?php if ($result->num_rows > 0): ?>
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Job Ref</th>
                    <th>Name</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Suburb</th>
                    <th>State</th>
                    <th>Postcode</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Skills</th>
                    <th>Other Skills</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['jobRef']) ?></td>
                        <td><?= htmlspecialchars($row['firstName'] . " " . $row['lastName']) ?></td>
                        <td><?= $row['dob'] ?></td>
                        <td><?= $row['gender'] ?></td>
                        <td><?= htmlspecialchars($row['address']) ?></td>
                        <td><?= htmlspecialchars($row['suburb']) ?></td>
                        <td><?= $row['state'] ?></td>
                        <td><?= $row['postcode'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['phone'] ?></td>
                        <td><?= htmlspecialchars($row['skills']) ?></td>
                        <td><?= htmlspecialchars($row['otherSkills']) ?></td>
                        <td>
                            <a href="update_application.php?id=<?= $row['id'] ?>">Update</a> | 
                            <a href="delete_application.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this application?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No applications found.</p>
    <?php endif; ?>

    <a href="admin_dashboard.php">← Back to Dashboard</a>
</body>
</html>

<?php $conn->close(); ?>