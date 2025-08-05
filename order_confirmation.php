<?php
session_start();

// Check if the session is still active
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    echo "<p>Your order has been successfully placed!</p>";
} else {
    echo "<p>Order could not be processed. Please try again later.</p>";
}
?>
