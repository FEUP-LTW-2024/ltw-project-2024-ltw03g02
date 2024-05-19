<?php function drawEditItem($idItemEdit) {
    require_once('../database/connection.db.php');
    require_once('../database/items.db.php');
    require_once('../templates/common/item_card.php');
    require_once('../templates/common/icon_btn.php');

    $db = getDatabaseConnection();
    $item = getItem($idItemEdit);
    if (empty($item)) {
        echo '<h2>Item not found</h2>';
        return;
    }

    ?>
    <div class="edit-item">
        <?php drawXmarkBtnWithLink('profile_page.php') ?>
        <h2>Edit Item</h2>
        <form id="edit-item-form" action="../actions/profile_page/action_edit_item.php" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf']; ?>">
            <input id="id-input-edit" type="hidden" name="idItem" class="input-edit-row idItem-input" value="<?php echo $item['idItem']; ?>" required>
            <div>
                <label for="title">Title</label>
                <input type="text" name="title" class="input-edit-row title-input" value="<?php echo $item['title']; ?>" required>
            </div>
            <div>
                <label for="description">Description</label>
                <input type="text" name="description" class="input-edit-row description-input" value="<?php echo $item['description']; ?>">
            </div>
            <div>
                <label for="color">Color</label>
                <select name="color" class="input-edit-row color-input" required>
                    <?php
                    $colors = getColors();
                    foreach ($colors as $colorRow) {
                        $color = $colorRow['color'];
                        $selected = $color == $item['color'] ? 'selected' : '';
                        echo "<option value=\"$color\" $selected>$color</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="type_item">Type</label>
                <select name="type_item" class="input-edit-row type_item-input" required>
                    <?php
                    $types = getTypeItems();
                    foreach ($types as $typeRow) {
                        $type_item = $typeRow['type_item'];
                        $selected = $type_item == $item['type_item'] ? 'selected' : '';
                        echo "<option value=\"$type_item\" $selected>$type_item</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="picture">Picture</label>
                <input type="text" name="picture" class="input-edit-row picture-input" value="<?php echo $item['picture']; ?>" required>
            </div>
            <div>
                <label for="price">Price</label>
                <input type="text" name="price" class="input-edit-row price-input" value="<?php echo $item['price']; ?>" required>
            </div>
            <div>
                <label for="condition">Condition</label>
                <select name="condition" class="input-edit-row condition-input" required>
                    <?php
                    $conditions = getConditions();
                    foreach ($conditions as $conditionRow) {
                        $idCondition = $conditionRow['idCondition'];
                        $conditionName = $conditionRow['conditionName'];
                        $selected = $condition == $item['condition'] ? 'selected' : '';
                        echo "<option value=\"$idCondition\" $selected>$conditionName</option>";
                    }
                    ?>
                </select>
            </div>
            <input type="hidden" name="sellerId" class="input-edit-row sellerId-input" value="<?php echo $item['sellerId']; ?>" required>
            <div>
                <label for="categoryId">Category</label>
                <select name="categoryId" class="input-edit-row categoryId-input" required>
                    <?php
                    $categories = getCategories();
                    foreach ($categories as $categoryRow) {
                        $categoryId = $categoryRow['idCategory'];
                        $categoryName = $categoryRow['categoryName'];
                        $selected = $categoryId == $item['categoryId'] ? 'selected' : '';
                        echo "<option value=\"$categoryId\" $selected>$categoryName</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="idBrand">Brand</label>
                <select name="idBrand" class="input-edit-row idBrand-input" required>
                    <?php
                    $brands = getBrands();
                    foreach ($brands as $brandRow) {
                        $brandId = $brandRow['idBrand'];
                        $brandName = $brandRow['brandName'];
                        $selected = $brandId == $item['idBrand'] ? 'selected' : '';
                        echo "<option value=\"$brandId\" $selected>$brandName</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="idSize">Size</label>
                <select name="idSize" class="input-edit-row idSize-input" required>
                    <?php
                    $sizes = getSizes();
                    foreach ($sizes as $sizeRow) {
                        $sizeId = $sizeRow['idSize'];
                        $sizeName = $sizeRow['sizeName'];
                        $selected = $sizeId == $item['idSize'] ? 'selected' : '';
                        echo "<option value=\"$sizeId\" $selected>$sizeName</option>";
                    }
                    ?>
                </select>
            </div>
            <button class="primary-btn" type="submit">Edit Item</button>
        </form>
    </div>
    <?php
}
?>