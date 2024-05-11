<?php
    declare(strict_types = 1);
    require_once('../../database/connection.db.php');

    $json = file_get_contents('php://input');

    $data = json_decode($json, true);

    $idCategory = $data['id'];

    $db = getDatabaseConnection();

    $stmt = $db->prepare('DELETE FROM Category 
        WHERE idCategory = :idCategory;');

    $stmt->bindParam(':idCategory', $idCategory);

    if (!$stmt->execute())
        echo "Error deleting category!";
    else
        echo "Category deleted successfully!";
?>