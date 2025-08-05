<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'supermart');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from the 'products' table
$sql = "SELECT * FROM products WHERE category_id = (SELECT id FROM categories WHERE name = 'Dairy Products')";
$result = $conn->query($sql);

// Display products
while ($row = $result->fetch_assoc()) {
    echo '<div class="product">';
    echo '<img src="' . $row['image_url'] . '" alt="' . $row['name'] . '">';
    echo '<h3>' . $row['name'] . '</h3>';
    echo '<p>' . $row['description'] . '</p>';
    echo '<p>Price: ₹' . $row['price'] . '</p>';
    echo '<a href="product_details.php?id=' . $row['id'] . '">View Details</a>';
    echo '</div>';
}

// Close the database connection
$conn->close();
?>
