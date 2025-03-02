<?php
include('db_connect.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch cart items
$query = "SELECT game_id FROM cart WHERE user_id='$user_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    header("Location: cart.php?error=empty_cart");
    exit();
}

// Insert purchases into `purchases` & `library`
while ($row = mysqli_fetch_assoc($result)) {
    $game_id = $row['game_id'];
    
    // Add to purchases table
    mysqli_query($conn, "INSERT INTO purchases (user_id, game_id, price, purchase_date, payment_status) 
                          VALUES ('$user_id', '$game_id', (SELECT price FROM games WHERE id='$game_id'), NOW(), 'Completed')");
    
    // Add to library
    mysqli_query($conn, "INSERT INTO library (user_id, game_id) VALUES ('$user_id', '$game_id')");
}

// Clear cart
mysqli_query($conn, "DELETE FROM cart WHERE user_id='$user_id'");

// Redirect to purchase success page
header("Location: purchase_success.php");
exit();
?>
