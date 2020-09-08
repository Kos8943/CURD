<?php
require __DIR__ . '/../part/__connect_db.php';


header('Content-Type: application/json');



$sql = "INSERT INTO `cart`(`img`, `name`, `price`, `quantity`) VALUES (?,?,?,?)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['img'],
    $_POST['name'],
    $_POST['price'],
    $_POST['quantity'],
]);





// echo $stmt->rowCount();
// echo 'ok';

if ($stmt->rowCount()) {
    $output['success'] = true;
    $output['quantity'] = $_POST['quantity'];
}



echo json_encode($output, JSON_UNESCAPED_UNICODE);
