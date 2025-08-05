<?php
// Start the session and check if the user is logged in as admin
session_start();

// For simplicity, assume an 'admin' session key indicates admin login status
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); // Redirect to login page if not admin
    exit;
}

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'supermart');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the counts of products, orders, and users
$productCountQuery = "SELECT COUNT(*) AS total_products FROM products";
$orderCountQuery = "SELECT COUNT(*) AS total_orders FROM orders";
$userCountQuery = "SELECT COUNT(*) AS total_users FROM user1";

$productCountResult = $conn->query($productCountQuery);
$orderCountResult = $conn->query($orderCountQuery);
$userCountResult = $conn->query($userCountQuery);

$productCount = $productCountResult->fetch_assoc()['total_products'];
$orderCount = $orderCountResult->fetch_assoc()['total_orders'];
$userCount = $userCountResult->fetch_assoc()['total_users'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Supermart</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Supermart Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="admindashboard.php">Dashboard</a></li>
                <li><a href="adminform.php">Manage Products</a></li>
                <li><a href="manage_orders.php">Manage Orders</a></li>
                <li><a href="manage_users.php">Manage Users</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main content -->
    <main>
        <h2>Welcome to the Admin Dashboard</h2>

        <!-- Statistics Cards -->
        <div class="dashboard-cards">
            <div class="card">
                <h3>Total Products</h3>
                <p><?php echo $productCount; ?></p>
            </div>
            <div class="card">
                <h3>Total Orders</h3>
                <p><?php echo $orderCount; ?></p>
            </div>
            <div class="card">
                <h3>Total Users</h3>
                <p><?php echo $userCount; ?></p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="actions">
            <h3>Actions</h3>
            <a href="manage_products.php" class="action-button">Manage Products</a>
            <a href="manage_orders.php" class="action-button">Manage Orders</a>
            <a href="manage_users.php" class="action-button">Manage Users</a>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Supermart. All Rights Reserved.</p>
    </footer>

</body>
</html>
