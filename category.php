<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'supermart');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all categories from the database
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category - Supermart</title>
    <link rel="stylesheet" href="6.css">
    <style>
        .categories {
            padding: 20px;
            text-align: center;
        }

        .categories h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            animation: fadeInDown 1s ease-in-out;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .category {
            background: #f4f4f4;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeIn 1.5s ease;
        }

        .category:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .category img {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
<header>
    <div class="logo">
        <h1>Supermart</h1>
    </div>
    <nav>
        <ul>
            <li><a href="6.php">Home</a></li>
            <li><a href="category.php">Categories</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="cart1.php">Cart </a></li>
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
        <section class="categories">
            <h2>Shop by Categories</h2>
            <div class="category-grid">
                <?php
                // Loop through and display the categories dynamically
                while ($row = $result->fetch_assoc()) {
                    // Handle missing images with a fallback
                    $imagePath = $row['image_url'];
                    if (!file_exists($imagePath)) {
                        $imagePath = 'images/default.jpg'; // Fallback image
                    }
                    echo '<div class="category">';
                    echo '<a href="' . strtolower(str_replace(' ', '', $row['name'])) . '.php">';
                    echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
                    echo '<img src="' . htmlspecialchars($imagePath) . '" alt="' . htmlspecialchars($row['name']) . '">';
                    echo '</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-links">
            <a href="aboutus.php">About Us</a>
            <a href="contact.php">Contact</a>
            <a href="privacy.php">Privacy Policy</a>
            <a href="terms.php">Terms of Service</a>
        </div>
        <p>&copy; 2024 Supermart. All Rights Reserved.</p>
    </footer>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
