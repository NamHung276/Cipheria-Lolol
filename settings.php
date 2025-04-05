<?php
$host = "localhost"; // Change this if using a different host
$username = "root"; // Change to your MySQL username
$password = ""; // Change to your MySQL password
$database = "job_portal"; // Your database name

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
