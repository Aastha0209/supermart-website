<?php
session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Your cart is empty.";
} else {
    echo "<h1>Your Shopping Cart</h1>";
    echo "<table border='1'>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>";

    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;

        echo "<tr>
                <td>{$item['name']}</td>
                <td>\${$item['price']}</td>
                <td>{$item['quantity']}</td>
                <td>\$$subtotal</td>
                <td><a href='remove_from_cart.php?id={$item['id']}'>Remove</a></td>
              </tr>";
    }

    echo "<tr>
            <td colspan='3'>Total</td>
            <td>\$$total</td>
            <td></td>
          </tr>";
    echo "</table>";
}
?>
