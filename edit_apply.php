<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
// Include database connection settings

include 'settings.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM applications WHERE id=$id");
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $job_ref = $_POST['jobRef'];
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE applications SET job_ref='$job_ref', first_name='$first_name', last_name='$last_name', email='$email', phone='$phone' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Application updated successfully!";
        header("Location: view_applications.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Application</title>
    <link rel="stylesheet" href="applystyle.css">
</head>
<body>
    <div class="container">
        <h2>Edit Application</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $row['id']; ?>">
            <label>Job Reference:</label>
            <input type="text" name="jobRef" value="<?= $row['job_ref']; ?>" required>
            <label>First Name:</label>
            <input type="text" name="firstName" value="<?= $row['first_name']; ?>" required>
            <label>Last Name:</label>
            <input type="text" name="lastName" value="<?= $row['last_name']; ?>" required>
            <label>Email:</label>
            <input type="email" name="email" value="<?= $row['email']; ?>" required>
            <label>Phone:</label>
            <input type="tel" name="phone" value="<?= $row['phone']; ?>" required>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>