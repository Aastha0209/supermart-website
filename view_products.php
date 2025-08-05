<?php
include 'db_connect.php';

$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : null;

// Prepare the SQL statement
$sql = "SELECT * FROM products";
if ($category_id) {
    $sql .= " WHERE category_id = ?";
}

$stmt = $conn->prepare($sql);
if ($category_id) {
    $stmt->bind_param("i", $category_id);
}
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. " - Price: $" . $row["price"]. "<br>";
    }
} else {
    echo "0 results";
}

$stmt->close();
$conn->close();
?>
