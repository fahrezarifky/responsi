<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
</head>
<body>
    <h2>Login Admin</h2>
    <?php if (isset($_SESSION['error'])): ?>
        <p style="color:red"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>

    <?php endif; ?>
    <form method="POST" action="auth/login_process.php">
        <label>Username</label><br>
        <input type="text" name="username" required><br><br>
        <label>Password</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
