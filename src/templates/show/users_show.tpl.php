<?php function drawUsers($usernamesAndProfilePictures) { ?>
    <h1>Send message to:</h1>
    <br>
    <br>
    <?php foreach ($usernamesAndProfilePictures as $user): ?>
        <div class="user-card">
        <a href="../../pages/chat.php?idUser=<?php echo $user['idUser']; ?>" onclick="saveIdUser(<?php echo $user['idUser']; ?>)">
                <img class="profile-image" src="<?php echo $user['profile_image_link']; ?>" />
                <span class="username"><?php echo $user['username']; ?></span>
            </a>
        </div>
        <hr class="separator">
    <?php endforeach; ?>
<?php } ?>