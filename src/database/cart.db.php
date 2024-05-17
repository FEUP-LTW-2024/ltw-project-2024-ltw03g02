<?php
    declare(strict_types = 1);
    require_once('connection.db.php');
    require_once('../classes/item.class.php');
    
    
    function getCartItems($cart) {
        $db = getDatabaseConnection();
        $items = array();

        foreach ($cart as $idItem) {
            $sql = 'SELECT * FROM Item WHERE idItem = :idItem;';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':idItem', $idItem);
            $stmt->execute();
            $item = $stmt->fetch();
            $items[] = $item;
        }
        
        return $items;
    }
?>