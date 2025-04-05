<?php
include 'settings.php'; // Connect to database

$sql = "SELECT * FROM applications ORDER BY submitted_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Applications</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>
    <h2>Submitted Job Applications</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Job Reference</th>
            <th>Name</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Skills</th>
            <th>Submitted At</th>
        </tr>
        
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['jobRef']}</td>
                    <td>{$row['firstName']} {$row['lastName']}</td>
                    <td>{$row['dob']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['address']}, {$row['suburb']}, {$row['state']}, {$row['postcode']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['skills']}</td>
                    <td>{$row['submitted_at']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No applications found</td></tr>";
        }
        ?>
    </table>
    <a href="index.html">← Back to Home</a>
</body>
</html>

<?php
$conn->close();
?>
