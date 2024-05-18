<?php
    declare(strict_types = 1);
    require_once('../database/connection.db.php');

    $db = getDatabaseConnection();

    $stmt = $db->prepare('INSERT INTO Item
        (title, description, color, type_item, picture, price, condition, sellerId, categoryId, idBrand, clotheSize, listedAt)
        VALUES (:title, :description, :color, :type_item, :picture, :price, :condition, :sellerId, :categoryId, :idBrand, :clotheSize, :listedAt);');
        
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
    $stmt->bindParam(':clotheSize', $_POST['idSize']);

    $listedAt = date('Y-m-d H:i:s');
    $stmt->bindParam(':listedAt', $listedAt);

    try {
        $stmt->execute();
        var_dump($_POST);
        echo "Item added successfully!";
        die(header('Location: ../../pages/profile_page.php'));
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

?>