<?php
session_start();

// Include the database connection
include 'connect.php'; // Ensure this file contains your mysqli connection code

// Check if the user is logged in
if (!isset($_SESSION['user1_id']) && !isset($_SESSION['guest_user'])) {
    // Store the current URL where the user was trying to add the item
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI']; // Store the URL
    header('Location: login1.php'); // Redirect to login page
    exit();
}

// Handle adding the product to the cart
if (isset($_GET['add'])) {
    // Fetch the product ID from the URL
    $product_id = intval($_GET['add']);

    // Check if product_id is valid
    if ($product_id <= 0) {
        echo "Invalid product ID.";
        exit();
    }

    // Check if the user is logged in
    if (isset($_SESSION['user1_id'])) {
        $user_id = $_SESSION['user1_id']; // Get the logged-in user's ID
    } else {
        // If not logged in, use the guest session ID
        $user_id = $_SESSION['guest_id']; // Using guest user ID if applicable
    }

    // Check if the product is already in the user's cart
    $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Product already in cart, increase the quantity
        $stmt = $conn->prepare("UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $user_id, $product_id);
    } else {
        // Product not in cart, add it
        $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)");
        $stmt->bind_param("ii", $user_id, $product_id);
    }

    // Execute the query and check for success
    if ($stmt->execute()) {
        // Redirect to cart page after adding product
        header('Location: cart1.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

