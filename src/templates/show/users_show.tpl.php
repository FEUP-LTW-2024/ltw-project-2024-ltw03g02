<?php function drawUsers($usernamesAndProfilePictures) { ?>
    <?php foreach ($usernamesAndProfilePictures as $user): ?>
        <div class="user-card">
        <a href="../../pages/chat.php?idUser=<?php echo $user['idUser']; ?>" onclick="saveIdUser(<?php echo $user['idUser']; ?>)">
                <img src="<?php echo $user['profile_image_link']; ?>" />
                <span><?php echo $user['username']; ?></span>
            </a>
        </div>
    <?php endforeach; ?>
<?php } ?>