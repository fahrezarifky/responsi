<?php
session_start();
if (!isset($_SESSION['admin'])) {
    echo "Unauthorized";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item'])) {
    require 'config.php';

    $item = trim($_POST['item']);
    if ($item !== "") {
        $stmt = $conn->prepare("INSERT INTO item_belanja (nama_item) VALUES (?)");
        $stmt->bind_param("s", $item);
        $stmt->execute();
        $stmt->close();
    }
}
?>
