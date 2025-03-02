<?php include('db_connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Store</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php include('header.php'); ?>
    
    <h2>Latest Games</h2>
    <div class="games-list">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM games ORDER BY id DESC LIMIT 6");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='game'>";
            echo "<img src='images/" . $row['image'] . "' alt='" . $row['title'] . "'>";
            echo "<h3>" . $row['title'] . "</h3>";
            echo "<p>$" . $row['price'] . "</p>";
            echo "</div>";
        }
        ?>
    </div>
    <script src="animations.js"></script>

    <?php include('footer.php'); ?>
</body>
</html>