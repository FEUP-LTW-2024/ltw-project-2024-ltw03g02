<?php
    function filteredSearch(PDO $db, $clotheSize, $type_item, $categoryId, $orderBy) {
        include_once('connection.db.php');
        $db = getDatabaseConnection();

        $sql = 'SELECT picture, username, price, clotheSize, type_item, categoryId, categoryName
            FROM Item 
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
        if ($orderBy != null) {
            $orderBy = strtoupper($orderBy);
            if ($orderBy == 'ASC' || $orderBy == 'DESC') {
                $sql .= ' ORDER BY price ' . $orderBy;
            }
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
      
        return $items;
    }

    function getItems() {
        include_once('connection.db.php');
        $db = getDatabaseConnection();

        $sql = 'SELECT * FROM Item 
                JOIN User ON sellerId=idUser 
                JOIN Category ON categoryId=idCategory';

        $stmt = $db->prepare($sql);

        $stmt->execute();
        $items = $stmt->fetchAll();
        return $items;
    } 
?>