<?php
include 'settings.php'; // Include database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM applications WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Application deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
