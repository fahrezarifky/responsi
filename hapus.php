<?php
session_start();
if (!isset($_SESSION['admin'])) {
    exit;
}

require 'config.php';

if (isset($_GET['reset']) && $_GET['reset'] == 1) {
    $conn->query("DELETE FROM item_belanja");
} elseif (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM item_belanja WHERE id = $id");
}
?>
