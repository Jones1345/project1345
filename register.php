<?php
include('db_connect.php');

$showPopup = false; // Variable to control popup visibility

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $hashed_password = md5($password); 

    $check_user = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check_user) > 0) {
        $message = "Email already exists!";
    } else {
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        if (mysqli_query($conn, $query)) {
            $showPopup = true; // Show success popup
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="register.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="register">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <!-- Success Popup -->
    <?php if ($showPopup): ?>
    <div class="popup" id="successPopup">
        <div class="popup-content">
            <h3>🎉 Registration Successful!</h3>
            <p>Welcome to the Game Store! You can now <a href="login.php">Login</a>.</p>
            <button onclick="closePopup()">OK</button>
        </div>
    </div>
    <script>
        function closePopup() {
            document.getElementById('successPopup').style.display = 'none';
            window.location.href = 'login.php'; // Redirect to login page
        }
    </script>
    <?php endif; ?>
</body>
</html>