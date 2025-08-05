<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Supermart</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="6.css" rel="stylesheet">
    <style>
        .fade-in {
            animation: fadeIn 2s ease-in-out;
        }

        .slide-in {
            animation: slideIn 1.5s ease-out;
        }

        .bounce-in {
            animation: bounceIn 1.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.8;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
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

<section class="about-us py-5">
    <div class="container slide-in">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="images/about-us.jpg" alt="About Us" class="img-fluid rounded shadow">
            </div>
            <div class="col-md-6">
                <h2>About Supermart</h2>
                <p>At Supermart, our mission is to make your shopping experience seamless, enjoyable, and convenient. Founded in 2014, we pride ourselves on offering a wide range of high-quality groceries and products at competitive prices.</p>
                <p>We understand the importance of time and quality in today's fast-paced world. That's why we are committed to providing you with an extensive selection of items that meet your needs and fit your lifestyle.</p>
                <p>Our team is dedicated to ensuring that your experience with us is top-notch, from the moment you browse our site to the delivery of your order.</p>
                <a href="contactus.php" class="btn btn-primary mt-3">Contact Us</a>
            </div>
        </div>
    </div>
</section>

<section class="our-values py-5">
    <div class="container">
        <h2 class="text-center mb-4 fade-in">Our Core Values</h2>
        <div class="row text-center">
            <div class="col-md-4">
                <div class="card border-0 shadow py-4 bounce-in">
                    <div class="card-body">
                        <h5 class="card-title">Customer First</h5>
                        <p class="card-text">Your satisfaction is our priority. We aim to provide the best service and experience for all our customers.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow py-4 bounce-in" style="animation-delay: 0.3s;">
                    <div class="card-body">
                        <h5 class="card-title">Quality Products</h5>
                        <p class="card-text">We partner with trusted suppliers to ensure the highest quality of products on our shelves.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow py-4 bounce-in" style="animation-delay: 0.6s;">
                    <div class="card-body">
                        <h5 class="card-title">Sustainability</h5>
                        <p class="card-text">We care about the environment and actively seek ways to reduce waste and promote eco-friendly practices.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<footer>
    <div class="footer-links">
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
