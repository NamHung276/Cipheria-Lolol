<?php
$host = "feenix-mariadb.swin.edu.au"; // Change this if using a different host
$username = "s105556375"; // Change to your MySQL username
$password = "271106"; // Change to your MySQL password
$database = "s105556375_db"; // Your database name

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
