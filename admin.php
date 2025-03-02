<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

    <div class="admin-container">
        <?php include('admin_header.php'); ?><br><br>

        <!-- Add an image inside the admin panel -->
        <div class="admin-image">
            <img src="images/admin1.jpg" alt="Admin Dashboard">
        </div>
    </div>

</body>
</html>


