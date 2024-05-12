<?php function drawProfile() {
    require_once('../database/connection.db.php');
    $db = getDatabaseConnection();
    $stmt = $db->prepare('SELECT * FROM User WHERE idUser = :idUser');
    $stmt->bindParam(':idUser', $_SESSION['idUser']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $profile_picture = $user['profile_image_link'];
    $username = $user['username'];

    ?>
    <div class="profile-container">
        <div class="profile-header">
            <img src="<?php echo $profile_picture; ?>" alt="Profile Picture">
            <h2><?php echo $username; ?></h2>
        </div>
        <div class="profile-actions">
            <a href="edit_profile.php" class="btn">Editar perfil</a>
            <a href="messages.php" class="btn">Mensagens</a>
        </div>
        <div class="my-items">
            <h3>Meus artigos</h3>
                <?php
                    $items = getItems();
                    foreach ($items as $item) {
                        drawItemCard($item['picture'], $item['username'], $item['price'], $item['clotheSize'], $item['categoryName'], $item['type_item']);
                    }
                ?>
        </div>
    </div>
    <?php

}
?>
