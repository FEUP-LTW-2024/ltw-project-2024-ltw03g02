<?php function drawItemCard($picture, $username, $price, $size, $category, $type, $enableEdit) { ?>
    <div class="item-card">
        <img src="<?php echo $picture; ?>" />
        <?php
            if ($enableEdit) {
                drawEditBtn('#');
                drawDeleteBtn('#');
            } 
        ?>
        <button class="icon-btn buy-btn"><img src="../../images/item_card/cart_plus_solid.svg" /></button>
        <div class="item-card-info">
            <div>
                <img src="../../images/item_card/small_profile_pic.png" />
                <span><?php echo $username ?></span>
            </div>
            <span class="price-info"><?php echo "€ " . $price ?></span>
            <span class="size-info"><?php echo $size ?></span>
            <span class="type-info"><?php echo $type ?></span>
            <span class="category-info"><?php echo $category ?></span>
        </div>
    </div>
<?php } ?>
