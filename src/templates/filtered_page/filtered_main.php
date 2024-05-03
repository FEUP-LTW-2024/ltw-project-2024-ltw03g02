<?php include_once('../templates/common/item_card.php'); ?>
<?php function drawfilteredMain() { ?>
    <main>
        <section class="filters">
            <div class="filters-row">
                <select name="color">
                    <option value="">Select color</option>
                    <option value="red">Red</option>
                    <option value="blue">Blue</option>
                    <option value="green">Green</option>
                </select>
                <select name="size">
                    <option value="">Select size</option>
                    <option value="small">Small</option>
                    <option value="medium">Medium</option>
                    <option value="large">Large</option>
                </select>
            </div>
            <button class="clean-filters-btn">Limpar filtros</button>
        </section>
        <section class="items">
            <div class="item-list">
                <?php 
                    require_once(dirname(__DIR__).'/../classes/item.class.php');
                    require_once(dirname(__DIR__).'/../database/connection.db.php');

                    $db = getDatabaseConnection();
                    $stmt = $db->prepare('SELECT * FROM Item join User;');
                    $stmt->execute();
                    $items = $stmt->fetchAll();

                    foreach ($items as $item) {
                        $stmt = $db->prepare('SELECT * FROM Item;');
                        $stmt->execute();
                        $items = $stmt->fetchAll();
                        drawItemCard($item['username'], $item['price']);
                    }

                ?>
                <a href="#" class="expand-btn">
                    <button class="primary-btn">Ver mais...</button>
                </a>
            </div>
        </section>

    </main>
<?php } ?>