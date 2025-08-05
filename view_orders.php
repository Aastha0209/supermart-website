<?php
// Include the database connection
require_once('connect.php');

// Fetch the recent orders
$sql = "SELECT * FROM orders ORDER BY order_date DESC LIMIT 10";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders - Supermart Admin</title>
    <link rel="stylesheet" href="admin_dashboard.css">  <!-- Link to your custom CSS -->
</head>
<body>
    <header>
        <div class="logo">
            <h1>Supermart Admin Dashboard</h1>
        </div>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="manage_users.php">Manage Users</a></li>
                <li><a href="manage_products.php">Manage Products</a></li>
                <li><a href="view_orders.php">View Orders</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>Recent Orders</h2>

        <table>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Product</th>
                <th>Date</th>
                <th>Status</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['order_id'] . "</td>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['product_id'] . "</td>";
                    echo "<td>" . $row['order_date'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No orders found.</td></tr>";
            }
            ?>
        </table>
    </div>

    <footer>
        <p>&copy; 2024 Supermart. All Rights Reserved.</p>
    </footer>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
