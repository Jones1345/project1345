<?php
include('db_connect.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch cart items
$query = "SELECT games.id, games.title, games.price FROM cart 
          JOIN games ON cart.game_id = games.id 
          WHERE cart.user_id='$user_id'";
$result = mysqli_query($conn, $query);

$total = 0;
$games = [];

while ($row = mysqli_fetch_assoc($result)) {
    $games[] = $row;
    $total += $row['price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include('header.php'); ?>

    <div class="checkout-container">
        <h2>💳 Enter Payment Details</h2>
        
        <table>
            <tr><th>Game</th><th>Price</th></tr>
            <?php foreach ($games as $game): ?>
                <tr>
                    <td><?php echo $game['title']; ?></td>
                    <td>$<?php echo number_format($game['price'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <p><strong>Total: $<?php echo number_format($total, 2); ?></strong></p>

        <form action="process_payment.php" method="POST">
            <label>Cardholder Name:</label>
            <input type="text" name="cardholder_name" required>

            <label>Card Number:</label>
            <input type="text" name="card_number" required pattern="\d{16}" placeholder="">

            <label>Expiry Date:</label>
            <input type="month" name="expiry_date" required>

            <label>CVV:</label>
            <input type="text" name="cvv" required pattern="\d{3}" placeholder="">

            <button type="submit" class="btn">Pay Now</button>
        </form>
    </div>
</body>
</html>
