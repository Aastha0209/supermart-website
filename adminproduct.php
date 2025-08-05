<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Product</title>
    <link rel="stylesheet" href="adminproduct.css">
</head>
<body>
    <h2>Add a New Product</h2>
    <form action="add_product.php" method="POST" enctype="multipart/form-data">
        <!-- Product Name -->
        <div>
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <!-- Product Description -->
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
        </div>

        <!-- Product Price -->
        <div>
            <label for="price">Price ($):</label>
            <input type="number" step="0.01" id="price" name="price" required>
        </div>

        <!-- Product Image -->
        <div>
            <label for="image">Product Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>

        <!-- Category Dropdown -->
        <div>
            <label for="category">Category:</label>
            <select id="category" name="category_id" required>
                <?php
                // Fetch categories from the database
                $conn = new mysqli('localhost', 'root', '', 'supermart');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                // Get all categories
                $sql = "SELECT * FROM categories";
                $result = $conn->query($sql);
                
                // Populate the dropdown with categories
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                }
                
                // Close the database connection
                $conn->close();
                ?>
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" name="submit">Add Product</button>
    </form>
</body>
</html>
