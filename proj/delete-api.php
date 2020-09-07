<?php
require __DIR__ . '/../part/__connect_db.php';

$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'cart.php';

if (empty($_GET['sid'])) {
    header('Location: ' . $referer);
    exit;
}
$sid = intval($_GET['sid']) ?? 0;

$pdo->query("DELETE FROM cart WHERE sid=$sid ");
header('Location: ' . $referer);
