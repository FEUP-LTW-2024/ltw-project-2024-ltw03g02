<?php function chat() {

    require_once('../database/connection.db.php');
    require_once('../classes/user.class.php');
    require_once('../classes/message.class.php');
    require_once('../classes/session.class.php');

    $db = getDatabaseConnection();
    $currentUserId = $_SESSION['idUser'];
    $receiverId = $_GET['idUser'];

    $receiver = User::getUser($db, $receiverId);
    $sender = User::getUser($db, $currentUserId);
    $messages = Message::getMessagesBetweenUsers($db, $currentUserId, $receiverId);

?>
    <a href="messages.php" class="seta">
        <button>
            <img src="../../images/arrow.png" alt="Back" />
        </button>
    </a>
    <div id="chat-container">
        <h1>Chat with <?php echo $receiver->getUsername(); ?></h1>
        <div id="messages">
            <?php if (empty($messages)): ?>
                <p>No messages yet. Be the first to send a message!</p>
            <?php else: ?>
                <div class="message-box">
                    <?php foreach ($messages as $message): ?>
                        <?php if ($message->getSenderId() == $currentUserId): ?>
                            <div class="message own_messages">
                                <img class="profile_pictures" src="<?php echo $sender->getProfileImageLink(); ?>" />
                                <p class="message_own"><?php echo $message->getMessageText(); ?></p>
                                <p><small><?php echo $message->getSentAt(); ?></small></p>
                            </div>
                        <?php else: ?>
                            <div class="message received_messages">
                                <img class="profile_pictures_rec" src="<?php echo $receiver->getProfileImageLink(); ?>" />
                                <p class="message_rec"><?php echo $message->getMessageText(); ?></p>
                                <p><small><?php echo $message->getSentAt(); ?></small></p>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
        <section>
            <form id="chat-form" action="/../../actions/action_insert_chat.php" method="POST">
                <textarea id="chat-input" name="messageText" rows="3" cols="60" placeholder="Type your message" class="message_box_chat"></textarea>
                <input type="hidden" id="receiverId" name="receiverId" value="<?php echo $receiverId; ?>">
                <input type="submit" value="Send" class="primary-btn">
            </form>
        </section>  
        <script src="/../../js/chat.js"></script>               
    </div>
<?php } ?>