<?php
    declare(strict_types = 1);
    require_once('../../database/connection.db.php');

    $db = getDatabaseConnection();

    $stmt = $db->prepare('INSERT INTO Category 
        (categoryName)
        VALUES (:categoryName);');
        
    $stmt->bindParam(':categoryName', $_POST['categoryName']);

    $stmt->execute();
    
    echo "Category added successfully!";
    die(header('Location: ../../pages/admin_panel.php?state=categories'));

?>