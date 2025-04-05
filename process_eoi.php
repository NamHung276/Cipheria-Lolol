<?php
include 'settings.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {// Sanitize and validate inputs
    $jobRef      = trim($_POST['jobRef']);
    $firstName   = trim($_POST['firstName']);
    $lastName    = trim($_POST['lastName']);
    $dob         = $_POST['dob'];
    $gender      = $_POST['gender'] ?? '';
    $address     = trim($_POST['address']);
    $suburb      = trim($_POST['suburb']);
    $state       = $_POST['state'] ?? '';
    $postcode    = trim($_POST['postcode']);
    $email       = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $phone       = trim($_POST['phone']);
    $skills      = isset($_POST['skills']) ? implode(", ", $_POST['skills']) : "";
    $otherSkills = trim($_POST['otherSkills']);

    // Basic field validation
    if (!$jobRef || !$firstName || !$lastName || !$dob || !$gender || !$address || !$suburb || !$state || !$postcode || !$email || !$phone) {
        echo "<script>alert('Please fill in all required fields.'); window.history.back();</script>";
        exit();
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO applications 
        (jobRef, firstName, lastName, dob, gender, address, suburb, state, postcode, email, phone, skills, otherSkills) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "sssssssssssss",
        $jobRef,
        $firstName,
        $lastName,
        $dob,
        $gender,
        $address,
        $suburb,
        $state,
        $postcode,
        $email,
        $phone,
        $skills,
        $otherSkills
    );

    if ($stmt->execute()) {
        echo "<script>alert('Application submitted successfully!'); window.location.href = 'index.html';</script>";
    } else {
        echo "<script>alert('Error submitting application: " . $stmt->error . "'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: apply.html");
    exit();
}
?>