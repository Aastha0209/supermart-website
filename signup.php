<?php
// Database connection settings
$servername = "localhost";
$username = "root";  // Your database username
$password = "";      // Your database password
$dbname = "supermart";  // Your database name

$adminemail = 'admin@gmail.com';
$adminPassword = 'admin123';
// Create connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form fields are set
    if (isset($_POST['full-name'], $_POST['email'], $_POST['password'], $_POST['confirm-password'])) {
        
        // Get form data from POST request
        $fullName = $_POST['full-name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];

        // Validate if passwords match
        if ($password !== $confirmPassword) {
            echo "Passwords do not match.";
            exit;
        }

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            exit;
        }

        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        //check if admin
    if ($email === $adminemail && $password === $adminPassword) {
        echo "Welcome Admin!";
        // Redirect to admin page or dashboard
        header("Location: admindashboard.php");
        exit();
    }


        // Check if the email already exists in the database
        $emailCheckQuery = "SELECT * FROM user1 WHERE email = ?";
        $stmt = $conn->prepare($emailCheckQuery);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "This email is already registered.";
            exit;
        }

        // Insert the new user's data into the user1 table
        $insertQuery = "INSERT INTO user1 (full_name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sss", $fullName, $email, $hashedPassword);

        if ($stmt->execute()) {
            // Redirect to login page after successful registration
            header("Location: login.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Required form fields are missing.";
    }
}
?>
