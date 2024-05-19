<?php
    function getAllUsers() {
        require_once('connection.db.php');
        $db = getDatabaseConnection();

        $stmt = $db->prepare('SELECT idUser, profile_image_link, nome, username, email, address, rating, phoneNumber 
                            FROM User');
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
?>