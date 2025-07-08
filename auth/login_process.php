<?php
session_start();
require_once "../config.php";

$username = $_POST['username'];
$password = $_POST['password'];

// Gunakan SHA2 hashing (sama seperti saat insert)
$sql = "SELECT * FROM admin WHERE username = ? AND password = SHA2(?, 256)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $_SESSION['admin'] = $username;
    header("Location: ../dashboard.php");
} else {
    $_SESSION['error'] = "Username atau password salah!";
    header("Location: ../index.php");
}
