<?php function drawItemCard($username, $price, $size, $category, $type) { ?>
    <div class="item-card">
        <img src="../../images/item_card/item_card_example.png" />
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
