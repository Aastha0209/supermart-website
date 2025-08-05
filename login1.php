<?php
// Include the database connection file
include 'connect.php'; // Ensure this file contains your mysqli connection code

session_start(); // Start the session

// Admin credentials (you can change these as needed)
$adminemail = 'admin@gmail.com';
$adminPassword = 'admin123';

// Check if the form is submitted using POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        // Handle user login
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        // Basic input validation
        if (empty($email) || empty($password)) {
            echo "Both fields are required.";
            exit();
        }

        // Check if admin credentials match
        if ($email === $adminemail && $password === $adminPassword) {
            // Admin login successful
            $_SESSION['admin_logged_in'] = true; // Set admin session variable
            header("Location: admindashboard.php"); // Redirect to admin dashboard
            exit();
        }

        // Fetch the user from the database
        $stmt = $conn->prepare("SELECT * FROM user1 WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the user exists
        if ($result->num_rows === 0) {
            echo "Invalid email or password!";
            exit();
        }

        // Fetch user data
        $user = $result->fetch_assoc();

        // Verify the password (assuming password is hashed in the database)
        if (password_verify($password, $user['password'])) {
            // Successful login, set session variables
            $_SESSION['user1_id'] = $user['id'];       // Store user ID in session
            $_SESSION['user1_name'] = $user['full_name']; // Store user name in session

            // Optionally regenerate session ID for security
            session_regenerate_id(true);

            // Check if there's a redirect URL stored (e.g., for "Add to Cart" action)
            if (isset($_SESSION['redirect_after_login'])) {
                $redirect_url = $_SESSION['redirect_after_login'];
                unset($_SESSION['redirect_after_login']); // Clear the session variable
                header("Location: $redirect_url"); // Redirect to the original page (e.g., product or cart)
                exit();
            }

            // Redirect to user dashboard or homepage if no specific redirect URL
            header("Location: welcome.php"); // Redirect to welcome page for normal users
            exit();
        } else {
            echo "Invalid email or password!";
        }

        $stmt->close(); // Close prepared statement
    } elseif (isset($_POST['guest'])) {
        // Guest login logic
        $_SESSION['guest_user'] = true; // Set a session variable to identify the guest user
        $_SESSION['guest_id'] = session_id(); // Use the session ID as a unique identifier for the guest

        // Redirect to the homepage or category page for guest users
        header("Location: welcome.php"); // Redirect to welcome page for guest users
        exit();
    }
}

// Close the database connection
$conn->close();
?>
