<?php
session_start();
include('db_connect.php');

// Ensure only admins can access this page
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = floatval($_POST['price']);

    // Ensure the uploads directory exists
$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true); // Create folder if it doesn't exist
}

// File upload handling
$image = $_FILES['image']['name'];
$target_file = $upload_dir . basename($image);

if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    // Insert game details into the database
    $query = "INSERT INTO games (title, description, price, image) 
              VALUES ('$title', '$description', '$price', '$image')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Game added successfully!');</script>";
    } else {
        echo "<script>alert('Database error: " . mysqli_error($conn) . "');</script>";
    }
} else {
    echo "<script>alert('Failed to upload image');</script>";
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Game</title>
    <link rel="stylesheet" href="admin_add_game.css">
</head>
<body>
    <?php include('admin_header.php'); ?>

    <div class="form-container">
        <h2>Add a New Game</h2>
        <form action="admin_add_game.php" method="POST" enctype="multipart/form-data">
            <label>Title:</label>
            <input type="text" name="title" required>

            <label>Description:</label>
            <textarea name="description" required></textarea>

            <label>Price ($):</label>
            <input type="number" name="price" step="0.01" required>

            <label>Game Image:</label>
            <input type="file" name="image" accept="image/*" required>

            <button type="submit">Add Game</button>
        </form>
    </div>
</body>
</html>
