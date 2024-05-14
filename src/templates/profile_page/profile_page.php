<?php function drawProfile() {
    require_once('../database/connection.db.php');
    require_once('../classes/user.class.php');
    require_once('../templates/filtered_page/item_card.php');
    require_once('../templates/common/icon_btn.php');



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
                    $userId = $_SESSION['idUser']; 
                    $user = User::getUser($db, $userId); 
                    $items = User::getItems($db, $userId);
                    foreach ($items as $item) {
                        $enableEdit = ($item['sellerId'] == $userId); 
                        drawItemCard($item['picture'], $user->profile_image_link, $user->username, $item['price'], $item['clotheSize'], $item['categoryName'], $item['type_item'], $enableEdit);
                    }
                ?>
        </div>
    </div>
    <?php

}
?>
