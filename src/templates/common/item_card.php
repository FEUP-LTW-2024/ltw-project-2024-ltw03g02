<?php function drawItemCard($id, $picture, $profile_picture, $username, $price, $size, $category, $type, $enableEdit, $enableBuy) { ?>
    <div class="item-card">
        <a href="show_item.php?idItem=<?php echo $id ?>">
            <img src="<?php echo $picture; ?>" />
        </a>
        <?php
            if ($enableEdit) {
                drawEditBtn('#');
                drawDeleteBtn('#');
            } 
        ?>
        <?php
            if ($enableBuy) {
                echo '<button class="icon-btn buy-btn" onclick="buyBtnPressedHandler(<?php echo $id ?>);"><img src="../../images/icon_btn/cart_plus_solid.svg" /></button>';
            }
        ?>
        <div class="item-card-info">
            <div>
                <img src="<?php echo $profile_picture; ?>" />
                <span><?php echo $username ?></span>
            </div>
            <span class="price-info"><?php echo "€ " . $price ?></span>
            <span class="size-info"><?php echo $size ?></span>
            <span class="type-info"><?php echo $type ?></span>
            <span class="category-info"><?php echo $category ?></span>
        </div>
    </div>
<?php } ?>
