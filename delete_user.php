<?php
include('db_connect.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $deleteQuery = "DELETE FROM users WHERE id = $user_id";

    if (mysqli_query($conn, $deleteQuery)) {
        header("Location: admin_users.php");
        exit();
    } else {
        echo "Error deleting user.";
    }
}
?>
