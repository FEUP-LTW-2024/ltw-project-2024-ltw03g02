<?php include_once('item_card.php'); ?>
<?php include_once('filters.php'); ?>
<?php require_once(dirname(__DIR__) . '/../database/items.db.php'); ?>

<?php function drawfilteredMain() { ?>
    <main>
        <?php drawFilters(); ?>
        <section class="items">
            <div class="item-list">
                <?php
                    if (isset($_SESSION['user']) && $_SESSION['user']['isAdmin']) {
                        $enableEdit = 1;
                    } else {
                        $enableEdit = 0;
                    }
                    $items = getItems();
                    foreach ($items as $item) {
                        drawItemCard($item['picture'], $item['profile_image_link'], $item['username'], $item['price'], $item['sizeName'], $item['categoryName'], $item['type_item'], $enableEdit);
                    }
                ?>
                <!-- <div>
                    <button id="expand-btn" class="primary-btn">Ver mais...</button>
                </div> -->
            </div>
        </section>
    </main>
<?php } ?>