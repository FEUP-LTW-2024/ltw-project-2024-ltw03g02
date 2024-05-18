<?php function messages() { ?>
    <div class="header-container">
        <h1>Message</h1>
        <button class="message-button" onclick="window.location.href='../pages/users_show.php'">Send a new message</button>
    </div>

    <?php
        require_once('../database/connection.db.php');
        require_once('../classes/user.class.php');
        require_once('../classes/message.class.php');
        require_once('../classes/session.class.php');
        $db = getDatabaseConnection();
        $currentUser = $_SESSION['idUser'];
        $users = User::getUsersWithConversations($db, $currentUser);
    ?>

    <div class="user-list">
        <?php foreach ($users as $user): ?>
            <?php $lastMessage = Message::getLastMessage($db, $currentUser, $user->getUserId()); ?>
            <a href="../../pages/chat.php?idUser=<?php echo $user->getUserId(); ?>" onclick="saveIdUser()">
                <div class="user-box">
                    <img class="profile_pictures" src="<?php echo $user->getProfileImageLink(); ?>" />
                    <div class="user-info">
                        <p class="username"><strong><?php echo $user->getUsername(); ?></strong></p>
                        <p class="last-message"><?php echo $lastMessage->getMessageText(); ?></p>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

    <script src="../js/messages.js"></script>
<?php } ?>  