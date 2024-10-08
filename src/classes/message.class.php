
<?php

    require_once(dirname(__DIR__).'/classes/user.class.php');

    class Message {
        public $senderProfileImageLink;
        public $senderName;
        private $idMessage;
        private $senderId;
        private $receiverId;
        private $messageText;
        private $sentAt;

    public function __construct($idMessage, $senderId, $receiverId, $messageText, $sentAt) {
        $this->idMessage = $idMessage;
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
        $this->messageText = $messageText;
        $this->sentAt = $sentAt;
    }

    public function getSenderID() : int {
        return $this->senderId;
      }
      
      public function getReceiverID() : int {
        return $this->receiverId;
      }
      
      public function getMessageText() : string {
        return $this->messageText;
      }
      
      public function getSentAt() : string {
        return $this->sentAt;
      }

      public function send(PDO $pdo, $senderId, $receiverId, $messageText) {
        $sql = 'INSERT INTO Message (senderId, receiverId, messageText) VALUES (?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$senderId, $receiverId, $messageText]);
    }

    public static function getMessagesForUser(PDO $pdo, $idUser) {
        $sql = 'SELECT * FROM Message WHERE receiverId = ? ORDER BY sentAt ASC';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idUser]);

        $messages = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $messages[] = new Message($row['idMessage'], $row['senderId'], $row['receiverId'], $row['messageText'], $row['sentAt']);
        }

        return $messages;
    }

    public static function getMessagesBetweenUsers(PDO $pdo, $idUser1, $idUser2) {
        $sql = 'SELECT Message.*, User.nome as senderName, User.profile_image_link as senderProfileImageLink 
                FROM Message 
                INNER JOIN User ON Message.senderId = User.idUser 
                WHERE (senderId = ? AND receiverId = ?) OR (senderId = ? AND receiverId = ?) 
                ORDER BY sentAt ASC';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idUser1, $idUser2, $idUser2, $idUser1]);
    
        $messages = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $message = new Message($row['idMessage'], $row['senderId'], $row['receiverId'], $row['messageText'], $row['sentAt']);
            $message->senderName = $row['senderName'];
            $message->senderProfileImageLink = $row['senderProfileImageLink'];
            $messages[] = $message;
        }
    
        return $messages;
    }

    public static function getLastMessage(PDO $pdo, $senderId, $receiverId) {
      $sql = 'SELECT * FROM Message WHERE (senderId = :senderId AND receiverId = :receiverId) OR (senderId = :receiverId AND receiverId = :senderId) ORDER BY sentAt DESC LIMIT 1';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([':senderId' => $senderId, ':receiverId' => $receiverId]);
  
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($row) {
          return new Message(
              $row['idMessage'],
              $row['senderId'], 
              $row['receiverId'], 
              $row['messageText'], 
              $row['sentAt']  
          );
      }
  
      return "No messages found";
    }

}    
?>