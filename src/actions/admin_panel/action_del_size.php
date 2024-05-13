<?php
    declare(strict_types = 1);
    require_once('../../database/connection.db.php');

    $json = file_get_contents('php://input');

    $data = json_decode($json, true);

    $idSize = $data['id'];

    $db = getDatabaseConnection();

    $stmt = $db->prepare('DELETE FROM clotheSize 
        WHERE idSize = :idSize;');

    $stmt->bindParam(':idSize', $idSize);

    if (!$stmt->execute())
        echo "Error deleting size!";
    else
        echo "Size deleted successfully!";
?>