<?php
include('db_connect.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT purchases.id, users.username, games.title, purchases.price, purchases.purchase_date, purchases.payment_status 
          FROM purchases 
          JOIN users ON purchases.user_id = users.id 
          JOIN games ON purchases.game_id = games.id 
          ORDER BY purchases.purchase_date DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Purchase Details</title>
    <link rel="stylesheet" href="admin_purchase.css">
</head>
<body>
    <?php include('admin_header.php'); ?>

    <div class="admin-container">
        <h2>🛍️ Purchase Details</h2>
        <table class="small-game-table">
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Game</th>
                <th>Price</th>
                <th>Purchase Date</th>
                <th>Payment Status</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td>$<?php echo $row['price']; ?></td>
                    <td><?php echo $row['purchase_date']; ?></td>
                    <td><?php echo $row['payment_status']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
