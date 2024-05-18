<?php
declare(strict_types = 1);
require_once(dirname(__DIR__).'/database/connection.db.php');
require_once(dirname(__DIR__).'/classes/session.class.php');
require_once(dirname(__DIR__).'/classes/message.class.php');
require_once(dirname(__DIR__).'/classes/user.class.php');

$session = new Session();

// Check if user is logged in
if (!isset($_SESSION['idUser'])) {
    die(header('Location: ../pages/login.php'));
}

$currentUserId = $_SESSION['idUser'];
$receiverId = htmlentities($_POST['receiverId']);
$messageText = htmlentities($_POST['messageText']);

$db = getDatabaseConnection();

$stmt = $db->prepare('INSERT INTO Message (senderId, receiverId, messageText) VALUES (?, ?, ?)');
$stmt->execute(array($currentUserId, $receiverId, $messageText));

header('Location: ../pages/messages.php');
exit;
?>
