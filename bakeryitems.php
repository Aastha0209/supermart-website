<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'supermart');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products for Bakery Items category
$sql = "SELECT * FROM products WHERE category_id = (SELECT id FROM categories WHERE name = 'Bakery Items')";
$result = $conn->query($sql);

// Check for query error
if (!$result) {
    die("Error fetching products: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery Items</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        // JavaScript function to toggle product description visibility
        function toggleDescription(productId) {
            var description = document.getElementById('description-' + productId);
            var button = document.getElementById('view-details-btn-' + productId);

            if (description.style.display === "none") {
                description.style.display = "block";
                button.textContent = "Hide Details";
            } else {
                description.style.display = "none";
                button.textContent = "View Details";
            }
        }
    </script>
</head>
<body>

<header>
    <div class="logo">
        <h1>Supermart</h1>
    </div>
    <nav>
        <ul>
            <li><a href="6.html">Home</a></li>
            <li><a href="category.php">Categories</a></li>
            <li><a href="login.html">Login</a></li>
            <li><a href="cart1.html">Cart (0)</a></li>
            <li><a href="account.html">Account</a></li>
        </ul>
    </nav>
    <div class="search-bar">
        <input type="text" placeholder="Search for products...">
    </div>
</header>

<main>
    <h2>Fresh Bakery Items</h2>
    <div class="product-grid">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="product-card">';
            echo '<img src="' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['name']) . '">';
            echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
            echo '<p class="price">₹' . htmlspecialchars($row['price']) . '</p>';

            // View Details Button
            echo '<button id="view-details-btn-' . $row['id'] . '" class="view-details-btn" onclick="toggleDescription(' . $row['id'] . ')">View Details</button>';

            // Product Description (Initially hidden)
            echo '<div id="description-' . $row['id'] . '" class="product-description" style="display: none;">';
            echo '<p>' . htmlspecialchars($row['description']) . '</p>';
            echo '</div>';

            // Add To Cart Form
            echo '<form action="add_to_cart.php" method="POST">';
            echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';
            echo '<button type="submit" class="add-to-cart-btn">Add to Cart</button>';
            echo '</form>';

            // Buy Now Form
            echo '<form action="buy_now.php" method="POST">';
            echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';
            echo '<button type="submit" class="buy-now-btn">Buy Now</button>';
            echo '</form>';

            echo '</div>';
        }
    } else {
        echo '<p style="text-align: center; color: #555;">No products available in this category. Please check back later!</p>';
    }
    ?>
    </div>

</main>

<footer>
    <p>&copy; 2024 Supermart. All Rights Reserved.</p>
</footer>

</body>
</html>

<?php
$conn->close();
?>
