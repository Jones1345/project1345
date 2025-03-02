<?php
include('db_connect.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Get game details
if (isset($_GET['id'])) {
    $game_id = $_GET['id'];
    $query = "SELECT * FROM games WHERE id = $game_id";
    $result = mysqli_query($conn, $query);
    $game = mysqli_fetch_assoc($result);
}

// Update game details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $price = $_POST['price'];

    $updateQuery = "UPDATE games SET title='$title', price='$price' WHERE id=$game_id";
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: admin_games.php");
        exit();
    } else {
        echo "Error updating game.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Game</title>
    <link rel="stylesheet" href="admin_games.css">
</head>
<body>
    <?php include('admin_header.php'); ?>

    <div class="admin-container">
        <h2>✏️ Edit Game</h2>
        <form method="POST">
            <label>Title:</label>
            <input type="text" name="title" value="<?php echo $game['title']; ?>" required>

            <label>Price:</label>
            <input type="text" name="price" value="<?php echo $game['price']; ?>" required>

            <button type="submit" class="btn">Update Game</button>
        </form>
    </div>
</body>
</html>
