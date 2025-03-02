<?php
include('db_connect.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all games
$query = "SELECT * FROM games ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Game List</title>
    <link rel="stylesheet" href="admin_games.css">
</head>
<body>
    <?php include('admin_header.php'); ?>

    <div class="admin-container">
        <h2>🎮 Manage Games</h2>

        <div class="table-container">
            <table class="small-game-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Game</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['title']; ?></td>
                            <td><img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>"></td>
                            <td>$<?php echo $row['price']; ?></td>
                            <td>
                                <a href="edit_game.php?id=<?php echo $row['id']; ?>" class="edit-btn">✏️ Edit</a>
                                <a href="delete_game.php?id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this game?')">🗑️ Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
