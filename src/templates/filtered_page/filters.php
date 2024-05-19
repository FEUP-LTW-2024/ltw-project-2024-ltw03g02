<?php 
    require_once(dirname(__DIR__).'/../database/connection.db.php'); 
?>

<?php function drawfilters() { ?>
    <section class="filters">
        <div class="filters-row">
            <div id="type-filter" class="filter">
                <span>Tipo</span>
                <select id="type-filter-select" name="type" onchange="changedFilterValueHandler('type-filter-select')">
                    <option value="">-</option>
                    <?php
                        $db = getDatabaseConnection();
                        $stmt = $db->prepare('SELECT DISTINCT type_item FROM Item;');
                        $stmt->execute();
                        $types = $stmt->fetchAll();
                        $type_item = isset($_GET['type_item']) ? $_GET['type_item'] : null;
                        foreach ($types as $type) {
                            $selected = $type['type_item'] == $type_item ? 'selected' : '';
                            echo '<option value="'.$type['type_item'].'" '.$selected.'>'.$type['type_item'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div id="category-filter" class="filter">
                <span>Categoria</span>
                <select id="category-filter-select" name="category" onchange="changedFilterValueHandler('category-filter-select')">
                    <option value="">-</option>
                    <?php
                        $stmt = $db->prepare('SELECT * FROM Category;');
                        $stmt->execute();
                        $categories = $stmt->fetchAll();
                        $category_id = isset($_GET['idCategory']) ? $_GET['idCategory'] : null;
                        foreach ($categories as $category) {
                            $selected = $category['idCategory'] == $category_id ? 'selected' : '';
                            echo '<option value="'.$category['idCategory'].'" '.$selected.'>'.$category['categoryName'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div id="size-filter" class="filter">
                <span>Tamanho</span>
                <?php
                    $clotheSize = isset($_GET['clotheSize']) ? $_GET['clotheSize'] : null;
                    echo '<select id="size-filter-select" name="size" onchange="changedFilterValueHandler(\'size-filter-select\')">';
                    echo '<option value="">-</option>';
                    $stmt = $db->prepare('SELECT idSize, sizeName FROM clotheSize;');
                    $stmt->execute();
                    $sizes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($sizes as $size) {
                        $selected = $size['idSize'] == $clotheSize ? 'selected' : '';
                        echo "<option value='".$size['idSize']."' $selected>".$size['sizeName']."</option>";
                    }
                    echo '</select>';
                ?>
            </div>
            <div id="order-by-filter" class="filter">
                <span>Ordenar por preço</span>
                <?php
                    $orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : null;
                    echo '<select id="order-by-filter-select" name="order-by" onchange="changedFilterValueHandler(\'order-by-filter-select\')">';
                    echo '<option value="">-</option>';
                    $orders = ['asc' => 'Crescente', 'desc' => 'Decrescente'];
                    foreach ($orders as $value => $text) {
                        $selected = $value == $orderBy ? 'selected' : '';
                        echo "<option value='$value' $selected>$text</option>";
                    }
                    echo '</select>';
                ?>
            </div>
        </div>
        <div class="filtered-control-row">
            <a href="#" id="clean-filters" onclick="cleanFiltersHandler()">Limpar filtros</a>
        </div>
    </section>
<?php } ?>