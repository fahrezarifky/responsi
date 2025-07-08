<?php
session_start();
require_once "../config.php";

$username = $_POST['username'];
$password = $_POST['password'];

// Cek apakah username sudah ada
$check = $conn->prepare("SELECT id FROM admin WHERE username = ?");
$check->bind_param("s", $username);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    $_SESSION['reg_error'] = "Username sudah digunakan!";
    header("Location: ../register.php");
    exit();
}

// Simpan user baru
$stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, SHA2(?, 256))");
$stmt->bind_param("ss", $username, $password);
if ($stmt->execute()) {
    $_SESSION['reg_success'] = "Registrasi berhasil! Silakan login.";
    header("Location: ../register.php");
} else {
    $_SESSION['reg_error'] = "Registrasi gagal. Silakan coba lagi.";
    header("Location: ../register.php");
}
