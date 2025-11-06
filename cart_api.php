<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

$product = $_POST['product'] ?? '';
$action = $_POST['action'] ?? '';

if ($action === 'add' && $product) {
  $_SESSION['cart'][$product] = ($_SESSION['cart'][$product] ?? 0) + 1;
}

if ($action === 'remove' && $product) {
  unset($_SESSION['cart'][$product]);
}

$totalItems = array_sum($_SESSION['cart']);
echo json_encode(['total' => $totalItems]);
