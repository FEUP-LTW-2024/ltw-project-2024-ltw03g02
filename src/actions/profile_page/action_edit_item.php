<?php
    declare(strict_types = 1);
    require_once('../../database/connection.db.php');

    $db = getDatabaseConnection();

    $stmt = $db->prepare('UPDATE Item SET
        title = :title,
        description = :description,
        color = :color,
        type_item = :type_item,
        picture = :picture,
        price = :price,
        condition = :condition,
        sellerId = :sellerId,
        categoryId = :categoryId,
        idBrand = :idBrand,
        clotheSize = :idSize,
        listedAt = :listedAt
        WHERE idItem = :idItem;');
    
$stmt->bindParam(':idItem', $_POST['idItem']);
$stmt->bindParam(':title', $_POST['title']);
$stmt->bindParam(':description', $_POST['description']);
$stmt->bindParam(':color', $_POST['color']);
$stmt->bindParam(':type_item', $_POST['type_item']);
$stmt->bindParam(':picture', $_POST['picture']);
$stmt->bindParam(':price', $_POST['price']);
$stmt->bindParam(':condition', $_POST['condition']);
$stmt->bindParam(':sellerId', $_POST['sellerId']);
$stmt->bindParam(':categoryId', $_POST['categoryId']);
$stmt->bindParam(':idBrand', $_POST['idBrand']);
$stmt->bindParam(':idSize', $_POST['idSize']);
$stmt->bindParam(':listedAt', $_POST['listedAt']);

$stmt->execute();

echo "Item edited successfully!";
session_start();
$_SESSION['message'] = "Item edited successfully!";
die(header('Location: ../../pages/profile_page.php'));
?>