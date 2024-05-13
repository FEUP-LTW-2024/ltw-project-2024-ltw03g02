<?php
    declare(strict_types = 1);
    require_once('../../database/connection.db.php');

    $db = getDatabaseConnection();

    $stmt = $db->prepare('INSERT INTO User 
        (nome, username, email, pass, gender, address, profile_image_link, phoneNumber, is_admin)
        VALUES (:nome, :username, :email, :pass, :gender, :address, :profile_image_link, :phoneNumber, :is_admin);');
        
        try {
            $stmt->bindParam(':nome', $_POST['nome']);
            $stmt->bindParam(':username', $_POST['username']);
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->bindParam(':pass', $_POST['pass']);
            $stmt->bindParam(':gender', $_POST['gender']);
            $stmt->bindParam(':address', $_POST['address']);
            $stmt->bindParam(':profile_image_link', $_POST['profile_image_link']);
            $stmt->bindParam(':phoneNumber', $_POST['phoneNumber']);
            $stmt->bindParam(':is_admin', $_POST['is_admin']);
        
            $stmt->execute();
        
            echo "User added successfully!";
            die(header('Location: ../../pages/admin_panel.php'));
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

?>