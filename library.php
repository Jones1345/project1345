<?php
include('db_connect.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch purchased games from the library
$query = "SELECT games.title, games.image FROM library 
          JOIN games ON library.game_id = games.id 
          WHERE library.user_id='$user_id'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Library</title>
    <link rel="stylesheet" href="library.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include('header.php'); ?>

    <div class="library-container">
        <h2>🎮 My Game Library</h2>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <div class="game-grid">
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="game-card">
            <img src="<?php echo htmlspecialchars('images/' . $row['image']); ?>" 
                 alt="<?php echo htmlspecialchars($row['title']); ?>" 
                 onerror="this.onerror=null; this.src='default-image.jpg';">
            <p><?php echo htmlspecialchars($row['title']); ?></p>
        </div>
    <?php endwhile; ?>
             </div>

        <?php else: ?>
            <p>No games purchased yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>
