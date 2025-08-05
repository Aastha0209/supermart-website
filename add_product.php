<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'supermart');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if (isset($_POST['submit'])) {
    // Collect form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = $_POST['price'];
    $category_id = $_POST['category_id']; // Category ID from the form

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($imageName);

        // Check if the uploaded file is an image
        if (getimagesize($imageTmpName)) {
            // Move the uploaded file to the server directory
            if (move_uploaded_file($imageTmpName, $uploadFile)) {
                // Prepare SQL query to insert product into the products table
                $sql = "INSERT INTO products (name, description, price, image_url, category_id) 
                        VALUES ('$name', '$description', '$price', '$uploadFile', '$category_id')";

                // Execute query and check if successful
                if ($conn->query($sql) === TRUE) {
                    echo "New product added successfully!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your image.";
            }
        } else {
            echo "The uploaded file is not a valid image.";
        }
    } else {
        echo "Error: " . $_FILES['image']['error'];
    }
}

// Close the database connection
$conn->close();
?>
