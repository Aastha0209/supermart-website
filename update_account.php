<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

// Database connection
include 'connect.php';

// Get the form data
$fullName = $_POST['full-name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm-password'];

// Initialize query for updating user information
$query = "UPDATE user1 SET full_name = ?, email = ?";

// Prepare the statement
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $fullName, $email);

// If a new password is provided and confirmed, update it
if (!empty($password) && $password === $confirmPassword) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $query .= ", password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $fullName, $email, $hashedPassword);
}

// Execute the query
if ($stmt->execute()) {
    $_SESSION['user_name'] = $fullName;
    $_SESSION['user_email'] = $email;
    header('Location: account.html');
    exit();
} else {
    echo "Error updating account information.";
}

// Close the connection
$stmt->close();
$conn->close();
?>
