<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Supermart</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="6.css" rel="stylesheet">
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

        .contact-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .contact-form {
            background-color: #f4f4f4;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .contact-form button {
            background-color: #007acc;
            color: white;
            border: none;
            transition: background-color 0.3s ease;
        }

        .contact-form button:hover {
            background-color: #005f99;
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

<header class="fade-in">
    <div class="logo">
        <h1>Supermart</h1>
    </div>
    </div>
    <nav>
        <ul>
            <li><a href="6.html">Home</a></li>
            <li><a href="category.php">Categories</a></li>
            <li><a href="login.html">Login</a></li>
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
<section class="contact-section py-5">
    <div class="container fade-in">
        <div class="contact-header">
            <h2>Contact Us</h2>
            <p>We’d love to hear from you! Feel free to reach out with any questions, feedback, or concerns.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form class="contact-form">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Your Message" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="footer-links">
        <a href="aboutus.php">About Us</a> |
        <a href="privacy.php">Privacy Policy</a> |
        <a href="terms.php">Terms of Service</a>
    </div>
    <p>&copy; 2024 Supermart. All Rights Reserved.</p>
</footer>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>
