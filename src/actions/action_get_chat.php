<?php
include_once('../db/connection.php');

function getMessages($receiverId) {
    global $db;
    $query = $db->prepare('SELECT * FROM messages WHERE receiverId = ? OR senderId = ? ORDER BY timestamp ASC');
    $query->execute([$receiverId, $receiverId]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
?>

