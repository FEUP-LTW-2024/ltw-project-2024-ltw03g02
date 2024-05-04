<?php 
    require_once(dirname(__DIR__).'/../database/connection.db.php'); 
?>

<?php function drawfilters() { ?>
    <section class="filters">
        <div class="filters-row">
            <div id="type-filter" class="filter">
                <span>Tipo</span>
                <select id="type-filter-select" name="type" onchange="changedFilterValueHandler()">
                    <option value="">-</option>
                    <?php
                        $db = getDatabaseConnection();
                        $stmt = $db->prepare('SELECT DISTINCT type_item FROM Item;');
                        $stmt->execute();
                        $types = $stmt->fetchAll();
                        foreach ($types as $type) {
                            echo '<option value="'.$type['type_item'].'">'.$type['type_item'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div id="category-filter" class="filter">
                <span>Categoria</span>
                <select id="category-filter-select" name="category" onchange="changedFilterValueHandler()">
                    <option value="">-</option>
                    <?php
                        $stmt = $db->prepare('SELECT * FROM Category;');
                        $stmt->execute();
                        $categories = $stmt->fetchAll();
                        foreach ($categories as $category) {
                            echo '<option value="'.$category['categoryName'].'">'.$category['categoryName'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div id="size-filter" class="filter">
                <span>Tamanho</span>
                <select id="size-filter-select" name="size" onchange="changedFilterValueHandler()">
                    <option value="">-</option>
                    <?php
                        $stmt = $db->prepare('SELECT DISTINCT clotheSize FROM Item;');
                        $stmt->execute();
                        $categories = $stmt->fetchAll();
                        foreach ($categories as $category) {
                            echo '<option value="'.$category['clotheSize'].'">'.$category['clotheSize'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div id="order-by-filter" class="filter">
                <span>Ordenar por</span>
                <select id="order-by-filter-select" name="order-by" onchange="changedFilterValueHandler()">
                    <option value="">-</option>
                </select>
            </div>
        </div>
        <div class="filtered-control-row">
            <a href="#" id="clean-filters" onclick="cleanFiltersHandler()">Limpar filtros</a>
            <button class=primary-btn onclick="applyFiltersHandler()">Aplicar filtros</button>
        </div>
    </section>
<?php } ?>