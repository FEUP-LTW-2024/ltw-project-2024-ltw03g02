<?php
    declare(strict_types = 1);
    
    function insertInUserOrder($sellerId, $buyerId, $idItem, $paymentOption, $price){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('INSERT INTO UserOrder (idBuyer, idSeller, idItem, paymentOption, productPrice) VALUES (?, ?, ?, ?, ?);');
        $stmt->execute([$buyerId, $sellerId, $idItem, $paymentOption, $price]);
        return $db->lastInsertId();
    }

    function setItemSold($idItem, $idOrder){
        $db = getDatabaseConnection();
        $stmt = $db->prepare('UPDATE Item SET isSold = 1, idOrder = ? WHERE idItem = ?;');
        $stmt->execute([$idOrder, $idItem]);
    }

?>


<?php
    require_once('../database/connection.db.php');
    require_once('../classes/session.class.php');
    require_once('../database/cart.db.php');
    require_once('../classes/item.class.php');
    require_once('../database/items.db.php');

    session_start();

    $idUser = $_SESSION['idUser'];
    $cart = $_SESSION['cart'];

    foreach ($cart as $idItem) {
        $item = getItem($idItem);
        $sellerId = $item['sellerId'];
        $buyerId = $idUser;
        $idItem = $item['idItem'];
        $paymentOption = $_POST['paymentOption'];
        $price = $item['price'];
        $idOrder = insertInUserOrder($sellerId, $buyerId, $idItem, $paymentOption, $price);
        setItemSold($idItem, $idOrder);
    }

    $_SESSION['cart'] = [];

    header('Location: ../pages/finished.php');
?>