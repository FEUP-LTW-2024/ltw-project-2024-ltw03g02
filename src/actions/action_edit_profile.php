<?php
    declare(strict_types = 1);
    require_once('../../database/connection.db.php');

    $db = getDatabaseConnection();

    $stmt = $db->prepare('UPDATE User SET 
        nome = :nome, 
        username = :username, 
        email = :email, 
        pass = :pass, 
        gender = :gender, 
        address = :address, 
        profile_image_link = :profile_image_link, 
        phoneNumber = :phoneNumber, 
        WHERE idUser = :idUser;');

    $stmt->bindParam(':idUser', $_POST['idUser']);
    $stmt->bindParam(':nome', $_POST['nome']);
    $stmt->bindParam(':username', $_POST['username']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':pass', hash('sha256', $_POST['pass']));
    $stmt->bindParam(':gender', $_POST['gender']);
    $stmt->bindParam(':address', $_POST['address']);
    $stmt->bindParam(':profile_image_link', $_POST['profile_image_link']);
    $stmt->bindParam(':phoneNumber', $_POST['phoneNumber']);

    $stmt->execute();
    
    echo "Salvo!";
?>