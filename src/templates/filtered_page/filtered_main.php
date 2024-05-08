<?php include_once('item_card.php'); ?>
<?php include_once('filters.php'); ?>

<?php function getItems() {
    require_once(dirname(__DIR__).'/../database/connection.db.php');
    $db = getDatabaseConnection();

    $sql = 'SELECT * FROM Item 
            JOIN User ON sellerId=idUser 
            JOIN Category ON categoryId=idCategory';

    $stmt = $db->prepare($sql);

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
                    $items = getItems();
                    foreach ($items as $item) {
                        drawItemCard($item['picture'], $item['username'], $item['price'], $item['clotheSize'], $item['categoryName'], $item['type_item'], 1);
                    }
                ?>
                <div>
                    <button id="expand-btn" class="primary-btn">Ver mais...</button>
                </div>
            </div>
        </section>
    </main>
<?php } ?>