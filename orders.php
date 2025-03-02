<?php
session_start();
include('db_connect.php');

$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT games.title FROM orders JOIN games ON orders.game_id = games.id WHERE orders.user_id = $user_id");

while ($row = mysqli_fetch_assoc($result)) {
    echo "<p>{$row['title']}</p>";
}
?>