<?php
    declare(strict_types = 1);
    require_once('../database/connection.db.php');
    $db = getDatabaseConnection();

    if (isset($_GET['clotheSize'])) {
        $clotheSize = $_GET['clotheSize'];
    } else {
        $clotheSize = null;
    }

    if (isset($_GET['type_item'])) {
        $type_item = $_GET['type_item'];
    } else {
        $type_item = null;
    }

    if (isset($_GET['categoryId'])) {
        $categoryId = $_GET['categoryId'];
    } else {
        $categoryId = null;
    }

    $sql = 'SELECT * FROM Item 
            JOIN User ON sellerId=idUser 
            JOIN Category ON categoryId=idCategory';
    $sql .= ' WHERE 1=1';
    if ($clotheSize != null) {
        $sql .= ' AND clotheSize = :clotheSize';
    } 
    if ($type_item != null) {
        $sql .= ' AND type_item = :type_item';
    }
    if ($categoryId != null) {
        $sql .= ' AND categoryId = :categoryId';
    }  
    $sql .= ';';

    $stmt = $db->prepare($sql);
    if($type_item != null){
        $stmt->bindParam(':type_item', $type_item);
    }
    if($clotheSize != null){
        $stmt->bindParam(':clotheSize', $clotheSize);
    }
    if($categoryId != null){
        $stmt->bindParam(':categoryId', $categoryId);
    }

    $stmt->execute();
    $items = $stmt->fetchAll();
    echo json_encode($items);

?>