<?php
    function filteredSearch(PDO $db, $clotheSize, $type_item, $categoryId, $orderBy) {
        $db = getDatabaseConnection();

        $sql = 'SELECT idItem, picture, profile_image_link, username, price, sizeName, type_item, categoryId, categoryName
            FROM Item 
            JOIN User ON sellerId=idUser 
            JOIN Category ON categoryId=idCategory
            JOIN clotheSize ON clotheSize=idSize';
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

    function searchBar($searchTerm) {
        include_once('connection.db.php');
        $db = getDatabaseConnection();
        $sql = 'SELECT idItem, picture, profile_image_link, username, price, sizeName, type_item, categoryId, categoryName
            FROM Item 
            JOIN User ON sellerId=idUser 
            JOIN Category ON categoryId=idCategory
            JOIN clotheSize ON clotheSize=idSize';
        $sql .= ' WHERE 1=1';
        if (!empty($searchTerm)) {
            $sql .= ' AND (username LIKE :searchTerm OR type_item LIKE :searchTerm OR categoryName LIKE :searchTerm OR sizeName LIKE :searchTerm)';
        }
        $sql .= ';';

        $stmt = $db->prepare($sql);
        if (!empty($searchTerm)) {
            $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%');
        }
        $stmt->execute();
        $items = $stmt->fetchAll();
        
        return $items;
    }

    function getItems() {
        include_once('connection.db.php');
        $db = getDatabaseConnection();

        $sql = 'SELECT idItem, picture, profile_image_link, username, price, sizeName, type_item, categoryId, categoryName
            FROM Item 
            JOIN User ON sellerId=idUser 
            JOIN Category ON categoryId=idCategory
            JOIN clotheSize ON clotheSize=idSize;';

        $stmt = $db->prepare($sql);

        $stmt->execute();
        $items = $stmt->fetchAll();
        return $items;
    } 

    function getItem($idItem) {
        include_once('connection.db.php');
        $db = getDatabaseConnection();

        $sql = 'SELECT * FROM Item WHERE idItem=:idItem;';

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':idItem', $idItem);

        $stmt->execute();
        $item = $stmt->fetch();
        return $item;
    }

    function getColors() {
        include_once('connection.db.php');
        $db = getDatabaseConnection();

        $sql = 'SELECT DISTINCT color FROM Item;';

        $stmt = $db->prepare($sql);

        $stmt->execute();
        $colors = $stmt->fetchAll();
        return $colors;
    }

    function getSizes() {
        include_once('connection.db.php');
        $db = getDatabaseConnection();
    
        $sql = 'SELECT DISTINCT idSize, sizeName FROM clotheSize;';
    
        $stmt = $db->prepare($sql);
    
        $stmt->execute();
        $sizes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $sizes;
    }

    function getCategories() {
        include_once('connection.db.php');
        $db = getDatabaseConnection();

        $sql = 'SELECT * FROM Category;';

        $stmt = $db->prepare($sql);

        $stmt->execute();
        $categories = $stmt->fetchAll();
        return $categories;
    }

    function getTypeItems() {
        include_once('connection.db.php');
        $db = getDatabaseConnection();

        $sql = 'SELECT DISTINCT type_item FROM Item;';

        $stmt = $db->prepare($sql);

        $stmt->execute();
        $types = $stmt->fetchAll();
        return $types;
    }

    function getConditions() {
        include_once('connection.db.php');
        $db = getDatabaseConnection();

        $sql = 'SELECT DISTINCT condition FROM Item;';

        $stmt = $db->prepare($sql);

        $stmt->execute();
        $conditions = $stmt->fetchAll();
        return $conditions;
    }

    function getBrands() {
        include_once('connection.db.php');
        $db = getDatabaseConnection();
    
        $sql = 'SELECT idBrand, brandName FROM Brand;';
    
        $stmt = $db->prepare($sql);
    
        $stmt->execute();
        $brands = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $brands;
    }

?>