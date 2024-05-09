<?php
    declare(strict_types = 1);
    require_once('../database/connection.db.php');

    $json = file_get_contents('php://input');

    $data = json_decode($json, true);

    $idUser = $data['idUser'];

    $db = getDatabaseConnection();

    $stmt = $db->prepare('DELETE FROM User 
        WHERE idUser = :idUser;');
        
    $stmt->bindParam(':idUser', $idUser);

    if (!$stmt->execute())
        echo "Error deleting user!";
    else
        echo "User deleted successfully!";

?>