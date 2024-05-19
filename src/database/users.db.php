<?php
    function getAllUsers() {
        require_once('connection.db.php');
        $db = getDatabaseConnection();

        $stmt = $db->prepare('SELECT idUser, profile_image_link, nome, username, email, address, rating, phoneNumber 
                            FROM User');
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    function getUser($idUser) {
        require_once('connection.db.php');
        $db = getDatabaseConnection();

        $stmt = $db->prepare('SELECT idUser, profile_image_link, nome, username, email, address, rating, phoneNumber 
                            FROM User
                            WHERE idUser = :idUser');
        $stmt->bindParam(':idUser', $idUser);
        $stmt->execute();
        
        return $stmt->fetch();
    }

    function getOrder($orderId){
        require_once('connection.db.php');
        $db = getDatabaseConnection();

        $stmt = $db->prepare('SELECT *
                            FROM UserOrder
                            WHERE idOrder = :orderId');
        $stmt->bindParam(':orderId', $orderId);
        $stmt->execute();
        
        return $stmt->fetch();
    }
?>