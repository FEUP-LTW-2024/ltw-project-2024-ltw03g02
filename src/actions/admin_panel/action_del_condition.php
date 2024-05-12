<?php
    declare(strict_types = 1);
    require_once('../../database/connection.db.php');

    $json = file_get_contents('php://input');

    $data = json_decode($json, true);

    $idCondition = $data['id'];

    $db = getDatabaseConnection();

    $stmt = $db->prepare('DELETE FROM condition 
        WHERE idCondition = :idCondition;');

    $stmt->bindParam(':idCondition', $idCondition);

    if (!$stmt->execute())
        echo "Error deleting condition!";
    else
        echo "Condition deleted successfully!";
?>