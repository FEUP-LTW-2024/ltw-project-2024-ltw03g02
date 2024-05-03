<?php function drawItemCard($username, $price) { ?>
    <div class="item-card">
        <img src="../../images/item_card/item_card_example.png" />
        <div class="item-card-info">
            <div>
                <img src="../../images/item_card/small_profile_pic.png" />
                <span><?php echo $username ?></span>
            </div>
            <span><?php echo $price . "€" ?></span>
        </div>
    </div>
<?php } ?>
