<?php include_once('item_card.php'); ?>
<?php include_once('filters.php'); ?>

<?php function getItems() {
    require_once(dirname(__DIR__).'/../database/connection.db.php');

    $db = getDatabaseConnection();
    $stmt = $db->prepare(
        'SELECT * FROM Item 
        JOIN User ON sellerId=idUser 
        JOIN Category ON categoryId=idCategory;'
    );

    $stmt->execute();
    $items = $stmt->fetchAll();
    return $items;
} ?>

<?php function drawfilteredMain() { ?>
    <main>
        <?php drawFilters(); ?>
        <section class="items">
            <div class="item-list">
                <?php 
                    require_once(dirname(__DIR__).'/../classes/item.class.php');
                    require_once(dirname(__DIR__).'/../database/connection.db.php');

                    $items = getItems();

                    foreach ($items as $item) {
                        drawItemCard($item['username'], $item['price'], $item['clotheSize'], $item['type_item'], $item['categoryName']);
                    }

                ?>
                <div>
                    <button id="expand-btn" class="primary-btn">Ver mais...</button>
                </div>
            </div>
        </section>
    </main>
<?php } ?>