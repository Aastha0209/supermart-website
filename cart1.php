<?php
session_start();

// Include the database connection
include 'connect.php'; // Ensure this file contains your mysqli connection code

// Check if the user is logged in or a guest
if (!isset($_SESSION['user1_id']) && !isset($_SESSION['guest_user'])) {
    header('Location: login.php'); // Redirect to login if user is not logged in
    exit();
}

// Determine the user ID (logged-in user or guest user)
if (isset($_SESSION['user1_id'])) {
    $user_id = $_SESSION['user1_id']; // Use the logged-in user ID
} else {
    $user_id = $_SESSION['guest_user']; // Use the guest user ID (session ID for guest)
}

// Fetch products in the cart
$sql = "SELECT c.id AS cart_id, c.quantity, p.name, p.price, p.image_url FROM cart c
        JOIN products p ON c.product_id = p.id WHERE c.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Remove an item from the cart
if (isset($_GET['remove'])) {
    $cart_id = intval($_GET['remove']);
    
    // Remove the product from the cart
    $delete_sql = "DELETE FROM cart WHERE id = ? AND user_id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("ii", $cart_id, $user_id);
    $delete_stmt->execute();
    header('Location: cart1.php'); // Redirect to the same page after removal
    exit();
}

// Update the cart item quantity
if (isset($_POST['update_cart'])) {
    $cart_id = intval($_POST['cart_id']);
    $quantity = intval($_POST['quantity']);

    // Ensure quantity is a positive number
    if ($quantity > 0) {
        $update_sql = "UPDATE cart SET quantity = ? WHERE id = ? AND user_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("iii", $quantity, $cart_id, $user_id);
        $update_stmt->execute();
    }
    header('Location: cart1.php'); // Redirect after updating the cart
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - SuperMart</title>
    <link rel="stylesheet" href="cart1.css"> <!-- Link to your CSS file -->
    <script>
        // Confirm removal action with the user
        function confirmRemove(cartId) {
            if (confirm("Are you sure you want to remove this item from your cart?")) {
                window.location.href = 'cart1.php?remove=' + cartId;
            }
        }
    </script>
</head>
<body>
    <header>
        <div class="logo">
            <h1>SuperMart</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="category.html">Categories</a></li>
                <li><a href="login1.php">Login</a></li>
                <li><a href="cart1.php">Cart</a></li>
                <li><a href="account.html">Account</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Your Shopping Cart</h2>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $item_total = $row['price'] * $row['quantity'];
                        $total += $item_total;
                        echo "<tr>
                            <td><img src='" . htmlspecialchars($row['image_url']) . "' alt='" . htmlspecialchars($row['name']) . "' width='50'> " . htmlspecialchars($row['name']) . "</td>
                            <td>₹" . htmlspecialchars($row['price']) . "</td>
                            <td>
                                <form action='cart1.php' method='POST'>
                                    <input type='hidden' name='cart_id' value='{$row['cart_id']}'>
                                    <input type='number' name='quantity' value='{$row['quantity']}' min='1' required>
                                    <button type='submit' name='update_cart'>Update</button>
                                </form>
                            </td>
                            <td>₹$item_total</td>
                            <td><button onclick='confirmRemove({$row['cart_id']})'>Remove</button></td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Your cart is empty.</td></tr>";
                }
                ?>
                <tr>
                    <td colspan="3" style="text-align: right;"><strong>Total:</strong></td>
                    <td colspan="2">₹<?php echo number_format($total, 2); ?></td>
                </tr>
            </tbody>
        </table>
        <a href="checkout.php"><button class="checkout">Proceed to Checkout</button></a>
    </main>

    <footer>
        <div class="footer-links">
            <a href="aboutus.html">About Us</a>
            <a href="contact.html">Contact</a>
            <a href="privacy.html">Privacy Policy</a>
            <a href="terms.html">Terms of Service</a>
        </div>
        <p>&copy; 2024 SuperMart. All Rights Reserved.</p>
    </footer>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>