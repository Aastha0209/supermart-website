<?php
include 'connect.php'; // Include your database connection file

$result = $conn->query('SELECT * FROM products');
$products = [];

while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);
?>
