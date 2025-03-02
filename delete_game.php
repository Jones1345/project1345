<?php
include('db_connect.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Delete game
if (isset($_GET['id'])) {
    $game_id = $_GET['id'];
    $deleteQuery = "DELETE FROM games WHERE id = $game_id";

    if (mysqli_query($conn, $deleteQuery)) {
        header("Location: admin_games.php");
        exit();
    } else {
        echo "Error deleting game.";
    }
}
?>
