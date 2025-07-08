<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrasi Admin</title>
</head>
<body>
    <h2>Registrasi Admin</h2>
    <?php if (isset($_SESSION['reg_error'])): ?>
        <p style="color:red"><?= $_SESSION['reg_error']; unset($_SESSION['reg_error']); ?></p>
    <?php elseif (isset($_SESSION['reg_success'])): ?>
        <p style="color:green"><?= $_SESSION['reg_success']; unset($_SESSION['reg_success']); ?></p>
    <?php endif; ?>
    
    <form method="POST" action="auth/register_process.php">
        <label>Username</label><br>
        <input type="text" name="username" required><br><br>
        <label>Password</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit">Daftar</button>
    </form>
    <br>
    <a href="index.php">Kembali ke Login</a>
</body>
</html>
