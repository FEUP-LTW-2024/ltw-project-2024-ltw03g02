<?php
    declare(strict_types = 1);
    require_once('../../database/connection.db.php');

    try {
        $db = getDatabaseConnection();

        $stmt = $db->prepare('INSERT INTO Category (categoryName) 
                            VALUES (:name);');
            
        $stmt->bindParam(':name', $_POST['categoryName']);

        $stmt->execute();
        
        echo "Category added successfully!";
        die(header('Location: ../../pages/admin_panel.php?state=categories'));
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>