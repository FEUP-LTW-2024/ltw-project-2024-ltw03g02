<?php
    declare(strict_types = 1);
    require_once('../../database/connection.db.php');

    try {
        $db = getDatabaseConnection();

        $stmt = $db->prepare('INSERT INTO clotheSize (sizeName) 
                            VALUES (:sizeName);');
            
        $stmt->bindParam(':sizeName', $_POST['sizeName']);

        $stmt->execute();
        
        echo "Size added successfully!";
        die(header('Location: ../../pages/admin_panel.php?state=sizes'));
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>