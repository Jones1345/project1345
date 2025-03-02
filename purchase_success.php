<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Purchase Successful</title>
    <link rel="stylesheet" href="success.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include('header.php'); ?>

    <div class="success-container">
        <h2>✅ Purchase Successful!</h2>
        <p>Thank you for your purchase. Your games have been added to your library.</p>
        
        <a href="library.php" class="btn">Go to My Library</a>
        <a href="index.php" class="btn back">Return to Home</a>
    </div>
</body>
</html>