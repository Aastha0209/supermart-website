<?php
// Start the session
session_start();

// Include the database connection
include 'connect.php'; // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user1_id'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// Get the user's ID from the session
$user_id = $_SESSION['user1_id'];

// Fetch user details from the database
$sql = "SELECT email, full_name FROM user1 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Check if user exists
if (!$user) {
    echo "User not found.";
    exit();
}

// Update user information if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];

    // Sanitize the input before updating
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $full_name = htmlspecialchars($full_name);

    // Update user info in the database
    $update_sql = "UPDATE user1 SET email = ?, full_name = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssi", $email, $full_name, $user_id);
    $update_stmt->execute();

    if ($update_stmt->affected_rows > 0) {
        // Update session variables and notify user
        $_SESSION['email'] = $email;
        $_SESSION['full_name'] = $full_name;
        echo "<script>alert('Your profile has been updated.');</script>";
    } else {
        echo "<script>alert('No changes were made.');</script>";
    }
}

// Get cart count
$cart_sql = "SELECT COUNT(*) AS cart_count FROM cart WHERE user_id = ?";
$cart_stmt = $conn->prepare($cart_sql);
$cart_stmt->bind_param("i", $_SESSION['user1_id']);
$cart_stmt->execute();
$cart_result = $cart_stmt->get_result();
$cart_row = $cart_result->fetch_assoc();
$cart_count = $cart_row['cart_count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account - SuperMart</title>
    <link rel="stylesheet" href="account.css"> <!-- Link to your CSS file -->
</head>
<body>

<!-- Header Section (Same as homepage.css) -->
<!-- Header Section -->
<header>
    <div class="logo">
        <h1>Supermart</h1>
    </div>
    <nav>
        <ul>
            <li><a href="6.html">Home</a></li>
            <li><a href="category.php">Categories</a></li>
            <li><a href="login.html">Login</a></li>
            <li><a href="cart1.php">Cart (<?php echo count($_SESSION['cart']); ?>)</a></li>
            <li><a href="account.php">Account</a></li>
        </ul>
    </nav>
    <div class="search-bar">
        
            <input type="text" name="query" placeholder="Search for products..." required>
            <button type="submit">Search</button>
        
    </div>
</header>

<!-- Main Content Section -->
<main>
    <h2>Your Account</h2>

    <!-- Display user information -->
    <form action="account.php" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="full_name">Full Name:</label>
            <input type="text" name="full_name" id="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
        </div>
        <button type="submit">Update Profile</button>
    </form>

    <!-- Logout Button -->
    <form action="logout.php" method="POST">
        <button type="submit" name="logout">Logout</button>
    </form>
</main>

<!-- Footer Section -->
<footer>
    <div class="footer-links">
        <a href="aboutus.php">About Us</a>
        <a href="contactus.php">Contact</a>
        <a href="privacy.php">Privacy Policy</a>
        <a href="terms.php">Terms & Conditions</a>
    </div>
    <p>&copy; 2024 SuperMart. All rights reserved.</p>
</footer>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
