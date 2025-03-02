<?php
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $_SESSION['cart'] = array_diff($_SESSION['cart'], [$id]);
}
header("Location: cart.php");
?>