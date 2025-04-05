<?php
include 'settings.php';

$sql = "SELECT * FROM applications ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Applications</title>
    <link rel="stylesheet" href="applystyle.css">
</head>
<body>
    <div class="container">
        <h2>Job Applications</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Job Ref</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Skills</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['job_ref']; ?></td>
                    <td><?= $row['first_name'] . " " . $row['last_name']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['phone']; ?></td>
                    <td><?= $row['skills']; ?></td>
                    <td>
                        <a href="edit_apply.php?id=<?= $row['id']; ?>">Edit</a> |
                        <a href="delete_apply.php?id=<?= $row['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>

<?php $conn->close(); ?>
