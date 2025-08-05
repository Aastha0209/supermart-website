<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get product ID from the form
    $product_id = $_POST['product_id'];

    // Store product in the cart for checkout
    $_SESSION['cart'] = [$product_id];  // Single product for immediate purchase

    // Redirect to the checkout page
    header('Location: checkout.php');
    exit();
}
?>
