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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <link rel="stylesheet" href="cart.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include('header.php'); ?>

    <h2>🛒 Your Cart</h2>
    <table>
        <tr>
            <th>Game</th>
            <th>Price</th>
            <th>Remove</th>
        </tr>
        <?php
        $total = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>$" . $row['price'] . "</td>";
            echo "<td><a href='remove_from_cart.php?id=" . $row['id'] . "'>❌ Remove</a></td>";
            echo "</tr>";
            $total += $row['price'];
        }
        ?>
    </table>
    <p><strong>Total: $<?php echo number_format($total, 2); ?></strong></p>

    <form action="checkout.php" method="POST">
        <button type="submit" class="btn checkout-btn">Proceed to Checkout</button>
    </form>

    <script src="animations.js"></script>
</body>
</html>
