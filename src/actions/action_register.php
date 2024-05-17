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

    session_start();

    if (!valid_name($_POST['nome'])) {
        $_SESSION['error'] = "Username inválido. Por favor, tente novamente.";
        header('Location: ../pages/register.php');
        exit();
    }

    if (!valid_address($_POST['address'])) {
        $_SESSION['error'] = "Address inválido. Por favor, tente novamente.";
        header('Location: ../pages/register.php');
        exit();
    }

    if (!valid_email($_POST['email'])) {
        $_SESSION['error'] = "Email inválido. Por favor, tente novamente.";
        header('Location: ../pages/register.php');
        exit();
    }

    if (!valid_phone($_POST['phoneNumber'])) {
        $_SESSION['error'] = "Número de telefone inválido. Por favor, tente novamente.";
        header('Location: ../pages/register.php');
        exit();
    }

    if (!valid_CSRF($_POST['csrf'])) {
        $_SESSION['error'] = "Token CSRF inválido. Por favor, tente novamente.";
        header('Location: ../pages/register.php');
        exit();
    }

    $db = getDatabaseConnection();
    if ($_POST['password1'] === $_POST['password2']) {

        if (!valid_password($_POST['password1'])) {
            $_SESSION['error'] = "A palavra passe deve conter pelo menos 8 caracteres, ter uma letra maiúscula, uma letra minúscula e um número";
            die(header('Location: ../pages/register.php'));
        }

        $cost = ['cost' => 8];
        $stmt = $db->prepare('INSERT INTO User (nome, username, email, pass, gender, address, phoneNumber) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute(array($_POST['nome'], $_POST['username'], $_POST['email'], hash('sha256', $_POST['password1']), $_POST['gender'], $_POST['address'], $_POST['phoneNumber']));
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