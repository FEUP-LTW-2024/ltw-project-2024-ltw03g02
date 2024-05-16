<?php
    declare(strict_types = 1);
    require_once(dirname(__DIR__).'/database/connection.db.php');
    require_once(dirname(__DIR__).'/classes/session.class.php');
    require_once(dirname(__DIR__).'/utils/validator.php');
    require_once(dirname(__DIR__).'/classes/user.class.php');
    $session = new Session();

    $_SESSION['input']['username login'] = htmlentities($_POST['username']);
    $_SESSION['input']['pass login'] = htmlentities($_POST['pass']);
      $db = getDatabaseConnection();
      $user = User::getUserWithUsername($db, $_POST['username'], $_POST['pass']);
      
      if ($user) {
    
        $_SESSION['idUser'] = $user->idUser;
        $_SESSION['nome'] = $user->getName();
        $_SESSION['photo'] = $user->getPhoto();
    
        unset($_SESSION['input']['username login']);
        unset($_SESSION['input']['pass login']);
        $session->addMessage('success', "Logged in successfully. Welcome back, " . $user->getName() . "!");
        header('Location: /../pages/home_page.php');
    
      } else {
        $session->addMessage('error', 'Login failed. Invalid username or password.');
        die(header('Location: ../pages/login.php'));
      }
?>          