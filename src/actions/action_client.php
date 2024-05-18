<?php
    declare(strict_types = 1);
    require_once('../database/connection.db.php');
    require_once('../classes/session.class.php');
    require_once('../utils/validator.php');
    $session = new Session();

    // Check if user is logged in
    if (!isset($_SESSION['idUser'])) {
        die(header('Location: ../pages/login.php'));
    }

    $idUser = $_SESSION['idUser'];
    $message = htmlentities($_POST['client_support']);

    $db = getDatabaseConnection();

    $stmt = $db->prepare('INSERT INTO Apoio (idUser, message) VALUES (?, ?)');
    $stmt->execute(array($idUser, $message));

    header('Location: ../pages/support.php');
?>