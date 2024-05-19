<?php function drawItemCard($id, $picture, $profile_picture, $username, $price, $size, $category, $type, $enableEdit, $enableBuy, $otherVars) { ?>
    <div class="item-card">
        <a href="item_page.php?idItem=<?php echo $id ?>">
            <img src="<?php echo $picture; ?>" />
        </a>
        <?php
            if (isset($otherVars)) {
                $editPage = $otherVars[0];
                $deletePage = $otherVars[1];
                if ($enableEdit) {
                    drawEditBtnWithLink($editPage);
                    drawDeleteBtnWithLink($deletePage);
                } 
            }
        ?>
        <?php
            if ($enableBuy) { ?>
            <button class="icon-btn buy-btn" onclick="buyBtnPressedHandler(<?php echo $id ?>);"><img src="../../images/icon_btn/cart_plus_solid.svg" /></button>
        <?php
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
