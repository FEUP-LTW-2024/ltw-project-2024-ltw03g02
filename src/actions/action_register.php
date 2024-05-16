<?php
    declare(strict_types = 1);
    require_once('../database/connection.db.php');
    require_once('../classes/session.class.php');
    require_once('../utils/validator.php');
    $session = new Session();

    $_SESSION['input']['nome newUser'] = htmlentities($_POST['nome']);
    $_SESSION['input']['username newUser'] = htmlentities($_POST['username']);
    $_SESSION['input']['email newUser'] = htmlentities($_POST['email']);
    $_SESSION['input']['password1 newUser'] = htmlentities($_POST['password1']);
    $_SESSION['input']['password2 newUser'] = htmlentities($_POST['password2']);
    $_SESSION['input']['gender newUser'] = htmlentities($_POST['gender']);
    $_SESSION['input']['address newUser'] = htmlentities($_POST['address']);
    $_SESSION['input']['phoneNumber newUser'] = htmlentities($_POST['phoneNumber']);

    if (!(valid_name($_POST['nome']) && valid_address($_POST['address']) && valid_email($_POST['email']) && valid_phone($_POST['phoneNumber']) && valid_CSRF($_POST['csrf']))) {
        die(header('Location: /../pages/register.php'));
    }

    $db = getDatabaseConnection();
    if ($_POST['password1'] === $_POST['password2']) {

        if (!valid_password($_POST['password1'])) {
            die(header('Location: ../pages/register.php'));
        }

        $cost = ['cost' => 8];
        $stmt = $db->prepare('INSERT INTO User (nome, username, email, pass, gender, address, phoneNumber) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute(array($_POST['nome'], $_POST['username'], $_POST['email'], hash('sha256', $_POST['pass']), $_POST['gender'], $_POST['address'], $_POST['phoneNumber']));
        session_start();
        $_SESSION['idUser'] = $db->lastInsertId();

    } else {
        $session->addMessage('warning', "Password does not match");
        die(header('Location: /../pages/register.php'));
    }

    unset($_SESSION['input']);

    $session->addMessage('success', "User registered successfully!");
    header('Location: /../pages/home_page.php');
?>