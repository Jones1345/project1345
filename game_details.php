<?php
include('db_connect.php');
session_start();

if (!isset($_GET['id'])) {
    echo "Game not found!";
    exit;
}

$game_id = mysqli_real_escape_string($conn, $_GET['id']);
$query = "SELECT * FROM games WHERE id = '$game_id'";
$result = mysqli_query($conn, $query);
$game = mysqli_fetch_assoc($result);

if (!$game) {
    echo "Game not found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $game['title']; ?></title>
    <link rel="stylesheet" href="game_details.css">
</head>
<body>
    <?php include('header.php'); ?>
    
    <div class="game-details">
    <h2><?php echo $game['title']; ?></h2>
    <p><?php echo $game['description']; ?></p>
    <p class="price">💰 $<?php echo $game['price']; ?></p>
    
    <!-- Add to Cart -->
    <form action="add_to_cart.php" method="POST">
        <input type="hidden" name="game_id" value="<?php echo $game['id']; ?>">
        <button type="submit" class="btn cart-btn">🛒 Add to Cart</button>
    </form>

    <!-- Buy Now -->
    
</div>
<script src="animations.js"></script>
    
</body>
</html>