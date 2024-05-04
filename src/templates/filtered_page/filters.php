<?php 
    require_once(dirname(__DIR__).'/../database/connection.db.php'); 
?>

<?php function drawfilters() { ?>
    <section class="filters">
            <div class="filters-row">
                <select name="type">
                    <option value="" disabled selected>Tipo</option>
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
                <select name="category">
                    <option value="" disabled selected>Categoria</option>
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
                <select name="size">
                    <option value="" disabled selected>Tamanho</option>
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
                <select name="order-by">
                    <option value="" disabled selected>Ordenar por</option>
                    <option value="">-</option>
                </select>
            </div>
            <a href="#" class="clean-filters">Limpar filtros</a>
        </section>
<?php } ?>