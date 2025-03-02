<?php
include('db_connect.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT games.title, games.price, games.id 
          FROM cart 
          JOIN games ON cart.game_id = games.id 
          WHERE cart.user_id='$user_id'";
$result = mysqli_query($conn, $query);

$total = 0;
$items = [];

while ($row = mysqli_fetch_assoc($result)) {
    $total += $row['price'];
    $items[] = $row['title'];
}

$items_list = implode(", ", $items);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <link rel="stylesheet" href="payment.css">
</head>
<body>
    <?php include('header.php'); ?>

    <div class="payment-container">
        <h2>💳 Payment Checkout</h2>
        <p>You're about to purchase: <strong><?php echo $items_list; ?></strong></p>
        <p class="total-amount">Total: 💰 $<?php echo number_format($total, 2); ?></p>

        <form action="process_payment.php" method="POST">
            <input type="hidden" name="total" value="<?php echo $total; ?>">
            <button type="submit" class="paypal-btn">Pay with PayPal</button>
        </form>
    </div>
    <script src="animations.js"></script>
    <?php include('footer.php'); ?>
</body>
</html>
