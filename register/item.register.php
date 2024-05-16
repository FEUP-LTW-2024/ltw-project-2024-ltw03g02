<?php
  declare(strict_types = 1);
  require_once(dirname(__DIR__).'/templates/footer.php');
  require_once(dirname(__DIR__).'/templates/header.php');
  require_once(dirname(__DIR__).'/templates/message.php');
  require_once(dirname(__DIR__).'/classes/item.class.php');
  require_once(dirname(__DIR__).'/templates/item.tpl.php');
  require_once(dirname(__DIR__).'/database/connection.db.php');
  require_once(dirname(__DIR__).'/classes/session.class.php');
  $session = new Session();
  
  if (!$session->isLoggedIn()) {
    $session->addMessage('error', "Não é possivel executar isso. Faça login.");
    die(header('Location: ../pages/denied.php'));
  } 

  $_SESSION['input']['title'] = $_SESSION['input']['title'] ?? "";
  $_SESSION['input']['description'] = $_SESSION['input']['description'] ?? "";
  $_SESSION['input']['color'] = $_SESSION['input']['color'] ?? "";
  $_SESSION['input']['type_item'] = $_SESSION['input']['type_item'] ?? "";
  $_SESSION['input']['picture'] = $_SESSION['input']['picture'] ?? "";
  $_SESSION['input']['price'] = $_SESSION['input']['price'] ?? "";
  $_SESSION['input']['condition'] = $_SESSION['input']['condition'] ?? "";
  $_SESSION['input']['sellerId'] = $_SESSION['input']['sellerId'] ?? "";
  $_SESSION['input']['categoryId'] = $_SESSION['input']['categoryId'] ?? "";
  $_SESSION['input']['idBrand'] = $_SESSION['input']['idBrand'] ?? "";
  $_SESSION['input']['clotheSize'] = $_SESSION['input']['clotheSize'] ?? "";
  $_SESSION['input']['listedAt'] = date('Y-m-d H:i:s'); // Current date and time

  drawHeader();
  if (count($session->getMessages())) drawMessages($session);
  newItemForm();
  drawFooter(); 
?>