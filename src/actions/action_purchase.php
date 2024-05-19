<?php
    declare(strict_types = 1);
    require_once('../database/connection.db.php');
    require_once('../classes/session.class.php');
    require_once('../database/cart.db.php');
    require_once('../classes/item.class.php');
    require_once('../utils/validator.php');

    $session = new Session();

    // Check if user is logged in
    if (!isset($_SESSION['idUser'])) {
        die(header('Location: ../pages/login.php'));
    }

    $idUser = $_SESSION['idUser'];
    $option = htmlentities($_POST['payment']);

    $db = getDatabaseConnection();

    $stmt = $db->prepare('INSERT INTO UserOrder (idUser, idItem, method, state) VALUES (?, ?, ?, "Vendido")');
    foreach ($_SESSION['cart'] as $idItem) {
        $stmt->execute(array($idUser, $idItem, $option));
    }
    
    $_SESSION['cart'] = array();

    header('Location: ../pages/finished.php');
?>