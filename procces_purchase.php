<?php
include('db_connect.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$game_id = $_POST['game_id'];
$price = $_POST['price'];

// Dummy Card Validation (Replace with Payment API)
$card_number = $_POST['card_number'];
$cvv = $_POST['cvv'];

if (strlen($card_number) != 16 || strlen($cvv) != 3) {
    die("Invalid Card Details. Please go back and try again.");
}

// Store purchase in database
mysqli_query($conn, "INSERT INTO purchases (user_id, game_id, price, purchase_date, payment_status) 
                      VALUES ('$user_id', '$game_id', '$price', NOW(), 'Completed')");

// Redirect to confirmation page
header("Location: purchase_success.php");
exit();
?>
