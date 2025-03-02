<?php
include('db_connect.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$game_id = mysqli_real_escape_string($conn, $_POST['game_id']);

// Check if the game is already in the cart
$check_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id='$user_id' AND game_id='$game_id'");
if (mysqli_num_rows($check_cart) == 0) {
    // Add the game to the cart if not already present
    mysqli_query($conn, "INSERT INTO cart (user_id, game_id) VALUES ('$user_id', '$game_id')");
}

header("Location: cart.php");
?>

