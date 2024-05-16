<?php
    declare(strict_types = 1);
    require_once('../database/connection.db.php');
    require_once('../database/items.db.php');
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

    if (isset($_GET['orderBy'])) {
        $orderBy = $_GET['orderBy'];
    } else {
        $orderBy = null;
    }

    $items = filteredSearch($db, $clotheSize, $type_item, $categoryId, $orderBy);
    
    echo json_encode($items);

?>