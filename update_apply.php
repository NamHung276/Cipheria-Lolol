<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

require 'settings.php';

$id = $_GET['id'] ?? 0;
$sql = "SELECT * FROM applications WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$app = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    $updateSql = "UPDATE applications SET firstName = ?, lastName = ?, email = ?, phone = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ssssi", $firstName, $lastName, $email, $phone, $id);

    if ($updateStmt->execute()) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error updating application.";
    }
}
?>

<!-- Admin update form -->
<form method="POST">
    First Name: <input type="text" name="firstName" value="<?= htmlspecialchars($app['firstName']) ?>"><br>
    Last Name: <input type="text" name="lastName" value="<?= htmlspecialchars($app['lastName']) ?>"><br>
    Email: <input type="email" name="email" value="<?= htmlspecialchars($app['email']) ?>"><br>
    Phone: <input type="text" name="phone" value="<?= htmlspecialchars($app['phone']) ?>"><br>
    <button type="submit">Update</button>
</form>