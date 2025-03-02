<?php
include('db_connect.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: games.php");
    exit();
}

$game_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Fetch game details
$query = "SELECT * FROM games WHERE id='$game_id'";
$result = mysqli_query($conn, $query);
$game = mysqli_fetch_assoc($result);

if (!$game) {
    echo "Game not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buy <?php echo $game['title']; ?></title>
    <link rel="stylesheet" href="purchase.css">
</head>
<body>
    <?php include('header.php'); ?>

    <div class="purchase-container">
        <h2>🎮 Buy <?php echo $game['title']; ?></h2>
        <p><strong>Price: $<?php echo number_format($game['price'], 2); ?></strong></p>

        <form action="process_purchase.php" method="POST">
            <input type="hidden" name="game_id" value="<?php echo $game['id']; ?>">
            <input type="hidden" name="price" value="<?php echo $game['price']; ?>">

            <label>Cardholder Name:</label>
            <input type="text" name="cardholder_name" required>

            <label>Card Number:</label>
            <input type="text" name="card_number" pattern="\d{16}" placeholder="1234 5678 9012 3456" required>

            <label>Expiration Date:</label>
            <input type="month" name="expiry_date" required>

            <label>CVV:</label>
            <input type="text" name="cvv" pattern="\d{3}" placeholder="123" required>

            <button type="submit" class="btn buy-btn">Buy Now</button>
        </form>
    </div>
</body>
</html>
