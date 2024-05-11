<?php
    declare(strict_types = 1);
    require_once('../../database/connection.db.php');

    $json = file_get_contents('php://input');

    $data = json_decode($json, true);

    $id = $data['id'];

    $db = getDatabaseConnection();

    $stmt = $db->prepare('DELETE FROM Item 
        WHERE idItem = :id;');

    $stmt->bindParam(':id', $id);

    if (!$stmt->execute())
        echo "Error deleting user!";
    else
        echo "User deleted successfully!";

?>