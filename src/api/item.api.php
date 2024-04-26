<?php
  declare(strict_types = 1);
  require_once(dirname(__DIR__).'/database/connection.db.php');
  require_once(dirname(__DIR__).'/classes/item.class.php');
  require_once(dirname(__DIR__).'/classes/session.class.php');
  $session = new Session();

  $db = getDatabaseConnection();
  $dishes = Item::search($db, $_GET['categoryId'], $_GET['type_item'], $_GET['color'], $_GET['condition'], $_GET['idBrand'], $_GET['clotheSize']);

  echo json_encode($dishes);
?>