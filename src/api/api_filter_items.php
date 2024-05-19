<?php
    declare(strict_types = 1);
    require_once('../database/connection.db.php');
    require_once('../database/items.db.php');

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

    if (isset($_GET['itemsPerPage'])) {
        $itemsPerPage = $_GET['itemsPerPage'];
    } else {
        $itemsPerPage = 10;
    }

    if (isset($_GET['offset'])) {
        $offset = $_GET['offset'];
    } else {
        $offset = 0;
    }

    if (isset($_GET['searchTerm'])) {
        $searchTerm = $_GET['searchTerm'];
    } else {
        $searchTerm = '';
    }

    list($items, $totalItems) = filteredSearch($clotheSize, $type_item, $categoryId, $orderBy, $searchTerm, $itemsPerPage, $offset);
    
    echo json_encode([$items, $totalItems]);

?>