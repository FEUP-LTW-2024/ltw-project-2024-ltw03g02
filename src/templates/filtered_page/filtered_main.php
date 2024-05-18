<?php include_once(dirname(__DIR__) . '/../templates/common/item_card.php'); ?>
<?php include_once('filters.php'); ?>
<?php require_once(dirname(__DIR__) . '/../database/items.db.php'); ?>

<?php function drawfilteredMain() { ?>
    <main>
        <?php drawFilters(); ?>
        <section class="items">
            <div class="search-message">
                <?php
                    if (isset($_GET['searchTerm'])) {
                        echo '<h3>Resultados da pesquisa "' . $_GET['searchTerm'] . '":</h3>';
                    } else {
                        echo '<h3>Todos os resultados</h3>';
                    }
                ?>
            </div>
            <div class="item-list">
                <?php
                    if (isset($_GET['searchTerm'])) {
                        $items = searchBar($_GET['searchTerm']);
                    } else {
                        $items = getItems();
                    }
                    $enableEdit = 0;
                    $enableBuy = 1;
                    foreach ($items as $item) {
                        drawItemCard($item['idItem'], $item['picture'], $item['profile_image_link'], $item['username'], $item['price'], $item['sizeName'], $item['categoryName'], $item['type_item'], $enableEdit, $enableBuy);
                    }
                ?>
                <!-- <div>
                    <button id="expand-btn" class="primary-btn">Ver mais...</button>
                </div> -->
            </div>
        </section>
    </main>
<?php } ?>