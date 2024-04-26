<?php
  declare(strict_types = 1);
  require_once(dirname(__DIR__).'/database/connection.db.php');
  require_once(dirname(__DIR__).'/classes/user.class.php');
  require_once(dirname(__DIR__).'/classes/session.class.php');
  $session = new Session();

  if (!$session->isLoggedIn()) {
    $session->addMessage('error', "Order items not allowed. Please log in.");
    die(header('Location: ../pages/denied.php'));
  } 
  
  $db = getDatabaseConnection();
  $user = User::getUser($db, intval($_SESSION['idUser']));
  $orders = $_GET['type'] == "old" ? $user->getOldOrders($db) : $user->getNewOrders($db);

  echo json_encode($orders);
?>