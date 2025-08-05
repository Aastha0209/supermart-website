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

// Fetch products for Dairy category
$sql = "SELECT * FROM products WHERE category_id = (SELECT id FROM categories WHERE name = 'Snacks')";
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
    <title>Dairy Products</title>
    
    <style>
       
        /* Additional styles for the page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        /* Header Styles */
        header {
            background-color: #2c3e50;  /* Dark blue-gray for header */
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        header .logo h1 {
            font-size: 24px;
            font-weight: bold;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 5px 10px;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #3498db; /* Blue color on hover */
            text-decoration: underline;
        }

        .search-bar input {
            padding: 10px;
            width: 250px;
            border-radius: 5px;
            border: 1px solid #ddd;
            transition: width 0.3s ease;
        }

        .search-bar input:focus {
            width: 300px;
            outline: none;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .product-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            text-align: center;
            transition: transform 0.3s;
        }

        .product-card img {
            max-width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }

        .product-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .product-card h3 {
            font-size: 18px;
            margin: 10px 0;
        }

        .product-card p {
            font-size: 14px;
            color: #666;
        }

        .product-card .price {
            font-size: 16px;
            font-weight: bold;
            color: #0078D4;
            margin: 10px 0;
        }

        footer {
            background-color: #f4f4f4;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        /* View Details Button */
        .view-details-btn {
            padding: 8px 16px;
            background-color: #3498db; /* Blue for View Details */
            color: white;
            border: none;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .view-details-btn:hover {
            background-color: #2980b9;
        }

        /* Product Description */
        .product-description {
            margin-top: 15px;
            font-size: 14px;
            color: #555;
            text-align: left;
            display: none; /* Initially hidden */
        }

        .product-description p {
            line-height: 1.6;
        }
        .add-to-cart-btn, .buy-now-btn {
    padding: 8px 16px;
    background-color: #3498db; /* Blue for View Details */
    color: white;
    border: none;
    cursor: pointer;
    font-size: 14px;
    border-radius: 5px;
    margin-top: 10px;
    transition: background-color 0.3s;
}

.add-to-cart-btn:hover, .buy-now-btn:hover {
    background-color: #3498db; 
}

    </style>
   

    <script>
        // JavaScript function to toggle description visibility
        function toggleDescription(productId) {
            var description = document.getElementById('description-' + productId);
            var button = document.getElementById('toggle-btn-' + productId);
            if (description.style.display === "none") {
                description.style.display = "block";
                button.innerHTML = "Hide Details";
            } else {
                description.style.display = "none";
                button.innerHTML = "View Details";
            }
        }
    </script>
</head>
<body>
<!-- Header Section -->
<header>
    <div class="logo">
        <h1>Supermart</h1>
    </div>
    <nav>
        <ul>
            <li><a href="6.php">Home</a></li>
            <li><a href="category.php">Categories</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="cart1.php">Cart (0)</a></li>
            <li><a href="account.php">Account</a></li>
        </ul>
    </nav>
    <div class="search-bar">
    <form action="search.php" method="GET">
        <input type="text" name="query" placeholder="Search for products..." required>
        <button type="submit">Search</button>
    </form>
    </div>
</header>
<main>
    <h2 style="text-align: center; margin: 20px 0;">Snacks</h2>

    <div class="product-grid">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="product-card">';
            echo '<img src="' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['name']) . '">';
            echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
            echo '<p class="price">₹' . htmlspecialchars($row['price']) . '</p>';
            // View Details Button and Description
            echo '<button id="toggle-btn-' . $row['id'] . '" class="view-details-btn" onclick="toggleDescription(' . $row['id'] . ')">View Details</button>';
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
// Close the database connection
$conn->close();
?>
