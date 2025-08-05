<?php
include 'connect.php'; // Include your database connection file

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - SuperMart</title>
    <link rel="stylesheet" href="products.css"> <!-- Link to your CSS file -->
</head>
<body>
    <header>
        <div class="logo">
            <h1>SuperMart</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="category.html">Categories</a></li>
                <li><a href="login.html">Login</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="account.html">Account</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Available Products</h2>
        <div class="product-list">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product'>
                        <img src='{$row['image_url']}' alt='{$row['name']}'>
                        <h3>{$row['name']}</h3>
                        <p>Price: \${$row['price']}</p>
                        <button onclick='addToCart({$row['id']})'>Add to Cart</button>
                    </div>";
                }
            } else {
                echo "<p>No products found.</p>";
            }
            ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 SuperMart. All Rights Reserved.</p>
    </footer>

    <script>
        function addToCart(productId) {
            const quantity = 1; // Set quantity to 1 for simplicity

            fetch('add_to_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ product_id: productId, quantity: quantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Product added to cart!');
                } else {
                    alert('Failed to add product to cart.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
