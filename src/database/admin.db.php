<?php 
    function getUsers() {
        require_once('connection.db.php');
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT *
                                FROM User;');
        $stmt->execute();
        $users = $stmt->fetchAll();
        return $users;
    }

    function getCategories() {
        require_once('connection.db.php');
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT *
                                FROM Category;');
        $stmt->execute();
        $categories = $stmt->fetchAll();
        return $categories;
    }

    function getItems() {
        require_once('connection.db.php');
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT *
                                FROM Item;');
        $stmt->execute();
        $items = $stmt->fetchAll();
        return $items;
    }

    function getSizes() {
        require_once('connection.db.php');
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT *
                                FROM clotheSize;');
        $stmt->execute();
        $sizes = $stmt->fetchAll();
        return $sizes;
    }
?>