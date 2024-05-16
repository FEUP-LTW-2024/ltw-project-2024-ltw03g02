<?php
    declare(strict_types = 1);
    require_once('../../database/connection.db.php');

    try {
        $db = getDatabaseConnection();

        $stmt = $db->prepare('INSERT INTO condition (conditionName) 
                            VALUES (:conditionName);');
            
        $stmt->bindParam(':conditionName', $_POST['conditionName']);

        $stmt->execute();
        
        echo "Condition added successfully!";
        die(header('Location: ../../pages/admin_panel.php?state=conditions'));
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>