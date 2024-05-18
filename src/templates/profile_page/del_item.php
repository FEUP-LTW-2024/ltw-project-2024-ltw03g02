<?php function drawDeleteItem($idItemDelete) {
    require_once('../database/connection.db.php');
    require_once('../database/items.db.php');
    require_once('../templates/common/item_card.php');
    require_once('../templates/common/icon_btn.php');

    $db = getDatabaseConnection();
    $item = getItem($idItemDelete);
    if (empty($item)) {
        echo '<h2>Item not found</h2>';
        return;
    }

    ?>
    <div class="delete-item">
        <?php drawXmarkBtnWithLink('profile_page.php') ?>
        <h2>Delete Item</h2>
        <div>
            <?php drawItemCard($item['idItem'], $item['picture'], $item['profile_image_link'], $item['username'], $item['price'], $item['sizeName'], $item['categoryName'], $item['type_item'], 0, 0, null); ?>
            <p>Are you sure you want to delete this item?</p>
            <form id="delete-item-form" action="../actions/profile_page/action_delete_item.php" method="post">
                <input id="id-input-delete" type="hidden" name="idItem" class="input-delete-row idItem-input" value="<?php echo $item['idItem']; ?>" required>
                <button class="primary-btn" type="submit">Delete Item</button>
            </form>
        </div>
    </div>
    <?php
}
?>