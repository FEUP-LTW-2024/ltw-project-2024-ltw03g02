<?php function drawEditItem($idItemEdit) {
    require_once('../database/connection.db.php');
    require_once('../classes/item.class.php');
    require_once('../templates/common/item_card.php');
    require_once('../templates/common/icon_btn.php');

    ?>
    <div class="edit-item">
        <?php drawXmarkBtnWithLink('profile_page.php') ?>
        <h2>Edit Item</h2>
        <form id="edit-item-form" action="../actions/admin_panel/action_edit_item.php" method="post">
            <div>
                <label for="idItem">Id</label>
                <input id="id-input-edit" type="text" name="idItem" class="input-edit-row idItem-input" required>
            </div>
            <div>
                <label for="title">Title</label>
                <input type="text" name="title" class="input-edit-row title-input" required>
            </div>
            <div>
                <label for="description">Description</label>
                <input type="text" name="description" class="input-edit-row description-input">
            </div>
            <div>
                <label for="color">Color</label>
                <input type="text" name="color" class="input-edit-row color-input" required>
            </div>
            <div>
                <label for="type_item">Type</label>
                <input type="text" name="type_item" class="input-edit-row type_item-input" required>
            </div>
            <div>
                <label for="picture">Picture</label>
                <input type="text" name="picture" class="input-edit-row picture-input" required>
            </div>
            <div>
                <label for="price">Price</label>
                <input type="text" name="price" class="input-edit-row price-input" required>
            </div>
            <div>
                <label for="condition">Condition</label>
                <input type="text" name="condition" class="input-edit-row condition-input" required>
            </div>
            <div>
                <label for="sellerId">Seller Id</label>
                <input type="text" name="sellerId" class="input-edit-row sellerId-input" required>
            </div>
            <div>
                <label for="categoryId">Category Id</label>
                <input type="text" name="categoryId" class="input-edit-row categoryId-input" required>
            </div>
            <div>
                <label for="idBrand">Brand Id</label>
                <input type="text" name="idBrand" class="input-edit-row idBrand-input" required>
            </div>
            <div>
                <label for="clotheSize">Clothe Size</label>
                <input type="text" name="clotheSize" class="input-edit-row clotheSize-input" required>
            </div>
            <button class="primary-btn" type="submit">Edit Item</button>
        </form>
    </div>
    <?php
}
?>