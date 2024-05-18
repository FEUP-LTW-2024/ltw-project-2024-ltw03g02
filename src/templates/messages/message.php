<?php function messages() { ?>
    <h1>Messages</h1>

    <div id="messages"></div>

    <h2>Send a new message</h2>

    <form id="message-form" action="../api/send_message.api.php" method="post">
        <label for="receiver_id">Receiver ID:</label>
        <input type="text" id="receiver_id" name="receiver_id" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>

        <input type="submit" name="send_message" value="Send">
    </form>

    <button onclick="window.location.href='../pages/users_show.php'">Send a message</button>

    <script src="../js/messages.js"></script>
<?php } ?>  