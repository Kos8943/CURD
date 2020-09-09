<?php
require __DIR__ . '/../part/__connect_db.php';


header('Content-Type: application/json');



$sql =  "UPDATE `cart` SET `quantity`=? WHERE `sid`=? ";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['quantity'],
    $_POST['sid'],
]);







// echo $stmt->rowCount();
// echo 'ok';

if ($stmt->rowCount()) {
    $output['success'] = true;
    $output['quantity'] = $_POST['quantity'];
}



echo json_encode($output, JSON_UNESCAPED_UNICODE);
