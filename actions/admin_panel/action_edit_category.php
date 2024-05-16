<?php
    declare(strict_types = 1);
    require_once('../../database/connection.db.php');

    $db = getDatabaseConnection();

    $stmt = $db->prepare('UPDATE Category SET categoryName = :name WHERE idCategory = :id;');
    
    $stmt->bindParam(':id', $_POST['idCategory']);
    $stmt->bindParam(':name', $_POST['categoryName']);

    $stmt->execute();

    echo "Category updated successfully!";
    die(header('Location: ../../pages/admin_panel.php?state=categories'));
?>