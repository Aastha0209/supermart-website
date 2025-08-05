<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user1_id'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// Get the user's name from the session
$user_name = isset($_SESSION['user1_name']) ? $_SESSION['user1_name'] : 'User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Supermart</title>
    <link rel="stylesheet" href="6.css"> <!-- Link to your shared CSS file -->
    <style>
        .fade-in {
            animation: fadeIn 2s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .slide-in {
            animation: slideIn 1.5s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .button {
            padding: 10px 20px;
            font-size: 1.1rem;
            background-color: #007acc; /* Button color */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
            display: inline-block;
            transition: background-color 0.3s, transform 0.2s;
        }

        .button:hover {
            background-color: #005f99;
            transform: translateY(-2px);
        }

        .welcome-container {
            text-align: center;
            padding: 40px 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        footer a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <header class="fade-in">
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
            <input type="text" placeholder="Search for products...">
        </div>
    </header>

    <!-- Main Section -->
    <section class="welcome-section py-5 fade-in">
        <div class="container">
            <div class="welcome-container slide-in">
                <h2>Welcome, <span id="full-name"><?php echo htmlspecialchars($user_name); ?></span>!</h2>
                <p>Thank you for logging in. You can now enjoy shopping, check your cart, and manage your account.</p>

                <!-- User Navigation Links -->
                <div class="user-nav">
                    <a href="category.php" class="button">Browse Products</a>
                    <a href="cart1.php" class="button">View Cart</a>
                    <a href="account.php" class="button">Manage Account</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <div class="footer-links">
            <a href="aboutus.php">About Us</a>
            <a href="contactus.php">Contact</a>
            <a href="privacy.php">Privacy Policy</a>
            <a href="terms.php">Terms of Service</a>
        </div>
        <p>&copy; 2024 Supermart. All Rights Reserved.</p>
    </footer>

</body>
</html>
