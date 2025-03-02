<?php
include('db_connect.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$game_id = mysqli_real_escape_string($conn, $_GET['id']);

mysqli_query($conn, "DELETE FROM cart WHERE user_id='$user_id' AND game_id='$game_id'");

header("Location: cart.php");
?>