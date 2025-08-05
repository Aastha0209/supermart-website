<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Supermart</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

    <!-- Login Section -->
    <section class="login">
        <h2>Login to Your Account</h2>
        <form action="login1.php" method="POST">
            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <!-- Login Button -->
            <button type="submit" name="login" class="btn-login">Login</button>
        </form>

        <!-- Continue as Guest Button -->
        <form action="guestuser.php" method="GET">
            <button type="submit" class="btn-guest">Continue as Guest</button>
        </form>

        <!-- Link to Sign Up page -->
        <p>Don't have an account? <a href="signup.html">Sign Up</a></p>
    </section>

    
</body>
</html>
