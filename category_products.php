<?php
// Get category_id from URL (e.g., category_products.php?category_id=2)
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : 1; // Default to 1 if no category is provided

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'supermart');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products based on the selected category
$sql = "SELECT * FROM products WHERE category_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $category_id);
$stmt->execute();
$result = $stmt->get_result();

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

// Close the connection
$conn->close();
?>
