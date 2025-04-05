<?php
session_start();
include 'settings.php';

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Check if it's an admin login first
    $stmt = $conn->prepare("SELECT id, password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    
    $stmt->execute();
    $stmt->store_result();

    // If admin exists, verify password
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // If password is correct, log the admin in
        if (password_verify($password, $hashed_password)) {
            $_SESSION['admin'] = true; // Set admin session variable
            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_username'] = $username;
            header("Location: admin.php"); // Redirect to admin panel
            exit();
        } else {
            echo "<script>alert('Incorrect password for admin'); window.history.back();</script>";
        }
    } else {
        // Check if it's a regular user if admin login fails
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch();

            // If password is correct, log the user in
            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                header("Location: dashboard.php"); // Redirect to user dashboard
                exit();
            } else {
                echo "<script>alert('Incorrect password for user'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Username not found'); window.history.back();</script>";
        }
    }

    $stmt->close();
    $conn->close();
} else {
    // If not POST request, redirect to login page
    header("Location: login.html");
    exit();
}
?>