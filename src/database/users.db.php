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
?>