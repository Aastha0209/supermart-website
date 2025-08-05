<?php
session_start();

// Ensure the user is logged in by checking the session
if (!isset($_SESSION['user1_id'])) {
    // If not logged in, redirect to the login page
    header("Location: login.html");
    exit();
}

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'supermart');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user_id from session (user1_id)
$user_id = $_SESSION['user1_id'];  // This will now be available since the user is logged in

// Fetch cart items from the database
$sql = "SELECT cart.*, products.name, products.price, products.image_url 
        FROM cart 
        INNER JOIN products ON cart.product_id = products.id 
        WHERE cart.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the cart items from the database
$cart_items = [];
while ($row = $result->fetch_assoc()) {
    $cart_items[] = $row; // Add product to cart items array
}

// Calculate the total price of the products in the cart
$total_price = 0;
foreach ($cart_items as $item) {
    $total_price += $item['price'] * $item['quantity']; // Add product price * quantity to total
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <div class="logo">
        <h1>Supermart</h1>
    </div>
    <nav>
        <ul>
            <li><a href="6.html">Home</a></li>
            <li><a href="category.php">Categories</a></li>
            <li><a href="login.html">Login</a></li>
            <li><a href="cart1.html">Cart (<?php echo count($cart_items); ?>)</a></li>
            <li><a href="account.html">Account</a></li>
        </ul>
    </nav>
</header>

<main>
    <h2>Checkout</h2>

    <h3>Your Cart</h3>
    <div class="product-grid">
        <?php
        if (count($cart_items) > 0) {
            foreach ($cart_items as $item) {
                echo '<div class="product-card">';
                echo '<img src="' . htmlspecialchars($item['image_url']) . '" alt="' . htmlspecialchars($item['name']) . '">';
                echo '<h3>' . htmlspecialchars($item['name']) . '</h3>';
                echo '<p>' . htmlspecialchars($item['description']) . '</p>';
                echo '<p class="price">₹' . htmlspecialchars($item['price']) . ' x ' . $item['quantity'] . '</p>';
                echo '</div>';
            }
        }
        ?>
    </div>

    <h3>Shipping Information</h3>
    <form action="process_order.php" method="POST">
        <label for="address">Shipping Address:</label>
        <textarea id="address" name="address" required placeholder="Enter your shipping address" rows="4"></textarea>

        <h3>Payment Information</h3>
        <label for="card_number">Card Number:</label>
        <input type="text" id="card_number" name="card_number" required placeholder="Enter card number">

        <label for="expiry_date">Expiry Date:</label>
        <input type="text" id="expiry_date" name="expiry_date" required placeholder="MM/YY">

        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" name="cvv" required placeholder="Enter CVV">

        <div class="total">
            <h3>Total: ₹<?php echo $total_price; ?></h3>
        </div>

        <button type="submit" class="checkout-btn">Place Order</button>
    </form>
</main>

<footer>
    <p>&copy; 2024 Supermart. All Rights Reserved.</p>
</footer>

</body>
</html>
