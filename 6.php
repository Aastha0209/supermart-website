<?php
// Start the session
session_start();

// Include the database connection
include 'connect.php';

// Initialize the cart count to 0 by default
$cart_count = 0;

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch the total number of items in the user's cart
    $query = "SELECT SUM(quantity) AS total_items FROM cart WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        $cart_count = $row['total_items']; // Set the cart count if found
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Supermart</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="6.css" rel="stylesheet">
    <!-- Animation Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>

<header class="animate__animated animate__fadeInDown">
    <div class="logo">
        <h1>Supermart</h1>
    </div>
    <nav>
        <ul>
            <li><a href="6.php">Home</a></li>
            <li><a href="category.php">Categories</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="cart1.php">Cart </a></li>
            <li><a href="account.php">Account</a></li>
        </ul>
    </nav>
    <div class="search-bar">
        <form action="search.php" method="GET">
            <input type="text" name="query" placeholder="Search for products..." required>
            <button type="submit">Search</button>
        </form>
    </div>
</header>

    <!-- Hero Section -->
    <section class="hero animate__animated animate__fadeIn">
        <h2>Welcome to Supermart</h2>
        <p>Your one-stop shop for all your grocery needs!</p>
        <a href="login.php"><button class="shop-now animate__animated animate__pulse animate__infinite">Shop Now</button></a>
    </section>

    <!-- Footer Section -->
    <footer class="animate__animated animate__fadeInUp">
        <div class="footer-links">
            <a href="aboutus.php">About Us</a> | 
            <a href="contactus.php">Contact</a> | 
            <a href="privacy.php">Privacy Policy</a> | 
            <a href="terms.php">Terms of Service</a>
        </div>
        <p>&copy; 2024 Supermart. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>
