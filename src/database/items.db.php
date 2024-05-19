<?php
    function filteredSearch($clotheSize, $type_item, $categoryId, $orderBy, $searchTerm, $itemsPerPage, $offset) {
        $db = getDatabaseConnection();

        // first I get the items here

        $sql = 'SELECT idItem, picture, profile_image_link, username, price, sizeName, type_item, categoryId, categoryName
            FROM Item 
            JOIN User ON sellerId=idUser 
            JOIN Category ON categoryId=idCategory
            JOIN clotheSize ON clotheSize=idSize';
        $sql .= ' WHERE 1=1 AND isSold=0';
        if ($clotheSize != null) {
            $sql .= ' AND clotheSize = :clotheSize';
        } 
        if ($type_item != null) {
            $sql .= ' AND type_item = :type_item';
        }
        if ($categoryId != null) {
            $sql .= ' AND categoryId = :categoryId';
        }  
        if (!empty($searchTerm)) {
            $sql .= ' AND (username LIKE :searchTerm OR type_item LIKE :searchTerm OR categoryName LIKE :searchTerm OR sizeName LIKE :searchTerm)';
        }
        if ($orderBy != null) {
            $orderBy = strtoupper($orderBy);
            if ($orderBy == 'ASC' || $orderBy == 'DESC') {
                $sql .= ' ORDER BY price ' . $orderBy;
            }
        }
        $sql .= ' LIMIT :itemsPerPage OFFSET :offset';
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
        if (!empty($searchTerm)) {
            $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%');
        }
        $stmt->bindValue(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        $items = $stmt->fetchAll();

        // now to count the items here

        $sql = 'SELECT count(*) as totalItems
            FROM Item 
            JOIN User ON sellerId=idUser 
            JOIN Category ON categoryId=idCategory
            JOIN clotheSize ON clotheSize=idSize';
        $sql .= ' WHERE 1=1 AND isSold=0';
        if ($clotheSize != null) {
            $sql .= ' AND clotheSize = :clotheSize';
        } 
        if ($type_item != null) {
            $sql .= ' AND type_item = :type_item';
        }
        if ($categoryId != null) {
            $sql .= ' AND categoryId = :categoryId';
        }  
        if (!empty($searchTerm)) {
            $sql .= ' AND (username LIKE :searchTerm OR type_item LIKE :searchTerm OR categoryName LIKE :searchTerm OR sizeName LIKE :searchTerm)';
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
        if (!empty($searchTerm)) {
            $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%');
        }

        $stmt->execute();
        $totalItems = $stmt->fetchColumn();

        return [$items, $totalItems];

    }

    function getItem($idItem) {
        include_once('connection.db.php');
        $db = getDatabaseConnection();
        error_log($idItem);
        $sql = 'SELECT idItem, sellerId, title, description, type_item, color, picture, price, condition, username, categoryName, brandName, sizeName, profile_image_link, condition
                FROM Item
                JOIN User ON sellerId=idUser
                JOIN Category ON categoryId=idCategory
                JOIN clotheSize ON clotheSize=idSize
                JOIN Brand ON Item.idBrand=Item.idBrand
                WHERE idItem=:idItem;';
    
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':idItem', $idItem);
    
        $stmt->execute();
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
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

        $sql = 'SELECT idCondition, conditionName FROM condition;';

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

    function getItemsBySeller($sellerId) {
        include_once('connection.db.php');
        $db = getDatabaseConnection();

        $sql = 'SELECT idItem, picture, profile_image_link, username, price, sizeName, type_item, categoryId, categoryName
            FROM Item 
            JOIN User ON sellerId=idUser 
            JOIN Category ON categoryId=idCategory
            JOIN clotheSize ON clotheSize=idSize
            WHERE sellerId = :sellerId AND isSold=0;';

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':sellerId', $sellerId);

        $stmt->execute();
        $items = $stmt->fetchAll();
        return $items;
    }

?>