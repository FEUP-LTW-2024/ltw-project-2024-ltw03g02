<?php
    declare(strict_types = 1);
    require_once(dirname(__DIR__).'/database/connection.db.php');
    require_once(dirname(__DIR__).'/classes/message.class.php');
    require_once(dirname(__DIR__).'/classes/session.class.php');

    $session = new Session();

    $db = getDatabaseConnection();

    // Get the POST data
    $receiverId = $_POST['receiver_id'];
    $messageText = $_POST['message'];

    // Create a new message
    $message = new Message($db);
    $message->setReceiverId($receiverId);
    $message->setMessage($messageText);

    // Save the message
    $message->save();

    // Return the new message as JSON
    echo json_encode($message);

?>