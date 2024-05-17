<?php
    declare(strict_types = 1);
    require_once('../database/connection.db.php');
    require_once('../classes/message.class.php');

    $db = getDatabaseConnection(); // Function to get the database connection

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['send_message'])) {
            if (!isset($_SESSION['idUser'])) {
                header('Location: ../pages/login.php');
                exit();
            }

            if (!isset($_POST['receiver_id']) || !isset($_POST['message'])) {
                die('Receiver ID or message is not set');
            }

            $sender_id = $_SESSION['idUser'];
            $receiver_id = $_POST['receiver_id'];
            $message = htmlentities($_POST['message']);

            $msg = new Message(null, $sender_id, $receiver_id, $message, null, false);
            $msg->send($db);

            header('Location: ../pages/messages.php');
            exit();
        }
    }
?>