<?php
    declare(strict_types = 1);
    require_once('../../database/connection.db.php');

    $id = $_POST['idItem'];

    $db = getDatabaseConnection();

    $stmt = $db->prepare('DELETE FROM Item 
        WHERE idItem = :id;');

    $stmt->bindParam(':id', $id);

    if (!$stmt->execute())
        echo "Error deleting Item!";
    else
        echo "Item deleted successfully!";

    die(header('Location: /pages/profile_page.php'));

?>