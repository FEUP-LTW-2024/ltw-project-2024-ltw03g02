<?php include_once('item_card.php'); ?>
<?php include_once('filters.php'); ?>
<?php function drawfilteredMain() { ?>
    <main>
        <?php drawFilters(); ?>
        <section class="items">
            <div class="item-list">
                <?php 
                    require_once(dirname(__DIR__).'/../classes/item.class.php');
                    require_once(dirname(__DIR__).'/../database/connection.db.php');

                    $db = getDatabaseConnection();
                    $stmt = $db->prepare(
                        'SELECT * FROM Item 
                        JOIN User ON sellerId=idUser 
                        JOIN Category ON categoryId=idCategory;');
                    $stmt->execute();
                    $items = $stmt->fetchAll();

                    foreach ($items as $item) {
                        $stmt = $db->prepare('SELECT * FROM Item;');
                        $stmt->execute();
                        $items = $stmt->fetchAll();
                        drawItemCard($item['username'], $item['price'], $item['clotheSize'], $item['type_item'], $item['categoryName']);
                    }

                ?>
                <a href="#" class="expand-btn">
                    <button class="primary-btn">Ver mais...</button>
                </a>
            </div>
        </section>

    </main>
<?php } ?>