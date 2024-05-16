<?php
    declare(strict_types = 1);
    require_once('../../database/connection.db.php');

    $db = getDatabaseConnection();

    $stmt = $db->prepare('UPDATE condition SET conditionName = :conditionName 
                            WHERE idCondition = :idCondition;');
    
    $stmt->bindParam(':idCondition', $_POST['idCondition']);
    $stmt->bindParam(':conditionName', $_POST['conditionName']);

    $stmt->execute();

    echo "Condition updated successfully!";
    die(header('Location: ../../pages/admin_panel.php?state=conditions'));
?>