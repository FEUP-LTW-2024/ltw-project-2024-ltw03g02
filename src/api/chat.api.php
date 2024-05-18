<?php
    declare(strict_types = 1);
    require_once(dirname(__DIR__).'/database/connection.db.php');
    require_once(dirname(__DIR__).'/classes/user.class.php');
    require_once(dirname(__DIR__).'/classes/message.class.php');
    require_once(dirname(__DIR__).'/classes/session.class.php');
    $session = new Session();

    $db = getDatabaseConnection();
    $users = User::getAllUsers($db);

    $currentUserId = $_SESSION['idUser'];

    $messagesBetweenOtherUsers = [];
    foreach ($users as $user) {
        $otherUserId = $user->getUserId();
        if ($otherUserId !== $currentUserId) {
            $messages = Message::getMessagesBetweenUsers($db, $currentUserId, $otherUserId);
            $messagesBetweenOtherUsers[$otherUserId] = $messages;
        }
    }

    
?>