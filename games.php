<?php
include('db_connect.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Games Store</title>
    <link rel="stylesheet" href="games.css">
</head>
<body>
<?php include('header.php'); ?>

    <div class="games-container">
        <h2>🎮 Browse Games</h2>
        <div class="games-list">
            <?php
            $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

            // Fetch games that are NOT purchased by the user
            $query = "SELECT * FROM games 
                      WHERE id NOT IN 
                      (SELECT game_id FROM library WHERE user_id = '$user_id')";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='game'>";
                    echo "<img src='images/" . $row['image'] . "' alt='" . $row['title'] . "'>";
                    echo "<h3>" . $row['title'] . "</h3>";
                    echo "<p>💰 $" . $row['price'] . "</p>";
                    echo "<a href='game_details.php?id=" . $row['id'] . "' class='btn'>View Details</a>";
                    echo "</div>";
                }
            } else {
                echo "<p class='no-games'>No games available.</p>";
            }
            ?>
        </div>
    </div>

    <script src="animations.js"></script>
</body>
</html>