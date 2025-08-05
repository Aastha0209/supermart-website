<?php
// Start the session and check admin login
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'supermart');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid user ID.");
}

$userId = intval($_GET['id']);

// Fetch user details
$userQuery = "SELECT id, full_name, email FROM user1 WHERE id = ?";
$stmt = $conn->prepare($userQuery);
$stmt->bind_param('i', $userId);
$stmt->execute();
$userResult = $stmt->get_result();
$userData = $userResult->fetch_assoc();
$stmt->close();

if (!$userData) {
    die("User not found.");
}

// Handle form submission for updating user details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['full_name']);
    $email = trim($_POST['email']);

    // Validation (optional but recommended)
    if (empty($full_name) || empty($email)) {
        $message = "Username and email cannot be empty.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email address.";
    } else {
        // Update user details
        $updateQuery = "UPDATE user1 SET full_name = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param('ssi', $username, $email, $userId);

        if ($stmt->execute()) {
            $message = "User updated successfully.";
            // Refresh user data
            $userData['full_name'] = $username;
            $userData['email'] = $email;
        } else {
            $message = "Error updating user: " . $conn->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Supermart Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Edit User</h1>
        <nav>
            <ul>
                <li><a href="admindashboard.php">Dashboard</a></li>
                <li><a href="adminform.php">Manage Products</a></li>
                <li><a href="manage_orders.php">Manage Orders</a></li>
                <li><a href="manage_users.php">Manage Users</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <h2>Edit User Details</h2>

        <!-- Success/Error Message -->
        <?php if (isset($message)): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <!-- Edit Form -->
        <form method="post" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="full_name" value="<?php echo htmlspecialchars($userData['full_name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
            </div>

            <button type="submit" class="btn">Update User</button>
            <a href="manage_users.php" class="btn cancel">Cancel</a>
        </form>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Supermart. All Rights Reserved.</p>
    </footer>

</body>
</html>
