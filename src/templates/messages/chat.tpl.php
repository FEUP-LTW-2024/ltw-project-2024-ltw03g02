<?php function chat() {

    require_once('../database/connection.db.php');
    require_once('../classes/user.class.php');
    require_once('../classes/message.class.php');
    require_once('../classes/session.class.php');

    $db = getDatabaseConnection();
    $currentUserId = $_SESSION['idUser'];
    $receiverId = $_GET['idUser'];

    $receiver = User::getUser($db, $receiverId);
    $messages = Message::getMessagesBetweenUsers($db, $currentUserId, $receiverId);

?>
    <div id="chat-container">
        <h1>Chat with User <?php echo $receiverId; ?></h1>
        <div id="messages">
            <?php if (empty($messages)): ?>
                <p>No messages yet. Be the first to send a message!</p>
            <?php else: ?>
                <?php foreach ($messages as $message): ?>
                    <div class="message">
                        <p><strong>From: </strong><?php echo $message->getSenderID(); ?></p>
                        <p><?php echo $message->getMessageText(); ?></p>
                        <p><small><?php echo $message->getSentAt(); ?></small></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <section>
            <form id="chat-form" action="/../../actions/action_insert_chat.php" method="POST">
                <textarea id="chat-input" name="messageText" placeholder="Type your message"></textarea>
                <input type="hidden" id="receiverId" name="receiverId" value="<?php echo $receiverId; ?>">
                <input type="submit" value="Send" class="primary-btn">
            </form>
        </section>  
        <script src="/../../js/chat.js"></script>               
    </div>
<?php } ?>