<?php
include 'connect.php'; // Include your database connection file

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Get the item ID and convert to an integer

    // Delete the item from the cart
    $sql = "DELETE FROM cart1 WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        // Redirect back to the cart page
        header("Location: cart.php");
        exit();
    } else {
        echo "Error removing item: " . $conn->error;
    }
    
    $stmt->close();
}

$conn->close(); // Close the database connection
?>
