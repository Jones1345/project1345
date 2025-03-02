<?php
session_start();
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $hashed_password = md5($password); // Use the same hashing method as your database

    // Check if user is an admin
    $adminQuery = "SELECT * FROM admin WHERE email='$email' AND password='$hashed_password'";
    $adminResult = mysqli_query($conn, $adminQuery);

    if (mysqli_num_rows($adminResult) > 0) {
        $admin = mysqli_fetch_assoc($adminResult);
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_email'] = $admin['email'];

        // Redirect to admin panel
        header("Location: admin.php");
        exit();
    }

    // Check if user is a normal user
    $userQuery = "SELECT * FROM users WHERE email='$email' AND password='$hashed_password'";
    $userResult = mysqli_query($conn, $userQuery);

    if (mysqli_num_rows($userResult) > 0) {
        $user = mysqli_fetch_assoc($userResult);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];

        // Redirect to normal user page
        header("Location: index.php");
        exit();
    }

    // If no user found
    $error = "Invalid email or password!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="login.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
            <br><br>
            <p style="color: white;">Don't have an account? <a href="register.php">Register</a></p>
        </form>
    </div>
</body>
</html>