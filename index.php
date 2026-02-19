<?php require_once 'includess/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Result Management System</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <p>Access your Result Management System</p>

    <form action="process_login.php" method="POST">
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" class="btn">Login</button>

        <div class="links">
            <a href="register.php">Create Account</a>
        </div>
    </form>
</div>

</body>
</html>
