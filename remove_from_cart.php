<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user1_id'])) {
    die("You must be logged in to remove items from the cart.");
}

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'supermart');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID from session
$user_id = $_SESSION['user1_id'];

// Check if cart_id is set in the POST request
if (isset($_POST['cart_id'])) {
    $cart_id = $_POST['cart_id'];

    // Remove the product from the cart for the logged-in user
    $sql = "DELETE FROM cart WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $cart_id, $user_id);

    if ($stmt->execute()) {
        // Item removed successfully, redirect back to the cart page or display a message
        echo "Item removed from cart successfully.";
        header("Location: cart.php");  // Redirect to cart page
        exit();
    } else {
        // If the delete operation fails
        echo "Error removing item from cart.";
    }
} else {
    // If cart_id is not provided
    echo "No cart item selected.";
}

$conn->close();
?>
