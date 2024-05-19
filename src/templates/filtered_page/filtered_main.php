<?php include_once(dirname(__DIR__) . '/../templates/common/item_card.php'); ?>
<?php include_once('filters.php'); ?>
<?php require_once(dirname(__DIR__) . '/../database/items.db.php'); ?>

<?php function drawfilteredMain() { ?>
    <main>
        <?php drawFilters(); ?>
        <section class="items">
            <?php 
                $itemsPerPage = 10;
                $pageNumber = isset($_GET['pageNum']) ? $_GET['pageNum'] : 1;
                $offset = ($pageNumber - 1) * $itemsPerPage;

                if (isset($_GET['clotheSize'])) {
                    $clotheSize = $_GET['clotheSize'];
                } else {
                    $clotheSize = null;
                }
            
                if (isset($_GET['type_item'])) {
                    $type_item = $_GET['type_item'];
                } else {
                    $type_item = null;
                }
            
                if (isset($_GET['idCategory'])) {
                    $categoryId = $_GET['idCategory'];
                } else {
                    $categoryId = null;
                }
            
                if (isset($_GET['orderBy'])) {
                    $orderBy = $_GET['orderBy'];
                } else {
                    $orderBy = null;
                }
            
                if (isset($_GET['searchTerm'])) {
                    $searchTerm = $_GET['searchTerm'];
                } else {
                    $searchTerm = '';
                }

                if (isset($_GET['pageNum'])) {
                    $pageNumber = $_GET['pageNum'];
                } else {
                    $pageNumber = 1;
                }

                $itemsPerPage = 10;
                $offset = ($pageNumber - 1) * $itemsPerPage;
            
                $result = filteredSearch($clotheSize, $type_item, $categoryId, $orderBy, $searchTerm, $itemsPerPage, $offset);
                $items = $result[0];
                $totalItems = $result[1];

                require_once(dirname(__DIR__) . '/../templates/filtered_page/pagination.php');

                $totalPages = ceil($totalItems / $itemsPerPage);
                
            ?>
            <div class="search-message">
                <?php
                    if (isset($_GET['searchTerm'])) {
                        echo '<h3>Resultados da pesquisa "' . $_GET['searchTerm'] . '" (' . $totalItems . '):</h3>';
                    } else {
                        echo '<h3>Todos os resultados (' . $totalItems . ')</h3>';
                    }
                    ?>
            </div>
            <?php
                if ($totalItems == 0) {
                    echo '<h3 id="no-items-message">Não foram encontrados resultados :(</h3>';
                } else {
                    drawPagination($totalPages, $pageNumber);
                }
            ?>
            <div class="item-list">
                <?php
                    session_start();
                    $enableEdit = 0;
                    if (isset($_SESSION['idUser'])) {
                        $enableBuy = 1;
                    } else {
                        $enableBuy = 0;
                    }
                    foreach ($items as $item) {
                        drawItemCard($item['idItem'], $item['picture'], $item['profile_image_link'], $item['username'], $item['price'], $item['sizeName'], $item['categoryName'], $item['type_item'], $enableEdit, $enableBuy, null);
                    }
                    ?>
            </div>
        </section>
    </main>
<?php } ?>