<?php
    declare(strict_types = 1);
    require_once('../../database/connection.db.php');

    $db = getDatabaseConnection();

    $stmt = $db->prepare('UPDATE clotheSize SET sizeName = :sizeName 
                            WHERE idSize = :idSize;');
    
    $stmt->bindParam(':idSize', $_POST['idSize']);
    $stmt->bindParam(':sizeName', $_POST['sizeName']);

    $stmt->execute();

    echo "Size updated successfully!";
    die(header('Location: ../../pages/admin_panel.php?state=sizes'));
?>