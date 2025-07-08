<?php
session_start();
if (!isset($_SESSION['admin'])) {
    echo json_encode([]);
    exit;
}

require 'config.php';

$result = $conn->query("SELECT * FROM item_belanja ORDER BY id DESC");
$items = [];

while ($row = $result->fetch_assoc()) {
    $items[] = $row;
}

echo json_encode($items);
?>
