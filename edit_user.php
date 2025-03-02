<?php
include('db_connect.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $updateQuery = "UPDATE users SET username='$username', email='$email' WHERE id=$user_id";
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: admin_users.php");
        exit();
    } else {
        echo "Error updating user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="admin_users.css">
</head>
<body>
    <?php include('admin_header.php'); ?>

    <div class="admin-container">
        <h2>✏️ Edit User</h2>
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo $user['username']; ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" required>

            

            <button type="submit" class="btn">Update User</button>
        </form>
    </div>
</body>
</html>
