<?php
session_start();

// Ensure the cart session variable is initialized as an array if not already set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'supermart');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products for Condiments & Spices category
$sql = "SELECT * FROM products WHERE category_id = (SELECT id FROM categories WHERE name = 'Condiments & Spices')";
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
    <title>Condiments & Spices</title>
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
            <li><a href="cart1.php">Cart (<?php echo count($_SESSION['cart']); ?>)</a></li>
            <li><a href="account.html">Account</a></li>
        </ul>
    </nav>
</header>

<main>
    <h2>Condiments & Spices</h2>
    <div class="product-grid">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Check if the product is already in the cart
            $is_in_cart = in_array($row['id'], $_SESSION['cart']);
            
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

            // Add To Cart or Remove from Cart Form
            if ($is_in_cart) {
                echo '<form method="POST" action="remove_from_cart.php">
                        <input type="hidden" name="product_id" value="' . $row['id'] . '">
                        <button type="submit" class="remove-btn">Remove from Cart</button>
                      </form>';
            } else {
                echo '<form method="POST" action="add_to_cart.php">
                        <input type="hidden" name="product_id" value="' . $row['id'] . '">
                        <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                      </form>';
            }

            echo '</div>';
        }
    } else {
        echo '<p>No products available in this category.</p>';
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
