<?php
  declare(strict_types = 1);
  require_once(dirname(__DIR__).'/templates/footer.php');
  require_once(dirname(__DIR__).'/templates/header.php');
  require_once(dirname(__DIR__).'/templates/message.php');
  require_once(dirname(__DIR__).'/templates/user.tpl.php');
  require_once(dirname(__DIR__).'/classes/session.class.php');
  $session = new Session();

  $_SESSION['input']['username newUser'] = $_SESSION['input']['username newUser'] ?? "";  
  $_SESSION['input']['nome newUser'] = $_SESSION['input']['nome newUser'] ?? "";
  $_SESSION['input']['morada newUser'] = $_SESSION['input']['morada newUser'] ?? "";
  $_SESSION['input']['telemovel newUser'] = $_SESSION['input']['telemovel newUser'] ?? "";
  $_SESSION['input']['email newUser'] = $_SESSION['input']['email newUser'] ?? "";
  $_SESSION['input']['genero newUser'] = $_SESSION['input']['genero newUser'] ?? "";
  $_SESSION['input']['profilePicture newUser'] = $_SESSION['input']['profilePicture newUser'] ?? "";
  $_SESSION['input']['password1 newUser'] = $_SESSION['input']['password1 newUser'] ?? "";
  $_SESSION['input']['password2 newUser'] = $_SESSION['input']['password2 newUser'] ?? "";

  drawHeader();
  if (count($session->getMessages())) drawMessages($session);
  drawRegisterUser();
  drawFooter(); 
?>