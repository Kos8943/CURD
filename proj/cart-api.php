<?php
require __DIR__ . '../part/part/__connect_db.php';


header('Content-Type: application/json');

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => ''
];





$sql = "INSERT INTO `cart`(`sid`, `img`, `name`, `price`, `quantity`) 
      VALUES (?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['sid'],
    $_POST['img'],
    $_POST['name'],
    $_POST['price'],
    $_POST['quantity']

]);

//echo $stmt->rowCount();
//echo 'ok';

if ($stmt->rowCount()) {
    $output['success'] = true;
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
