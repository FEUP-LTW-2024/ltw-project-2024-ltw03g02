<?php 
function drawItemPage() { 
    require_once('../database/items.db.php');
    if (!isset($_GET['idItem'])) {
        echo '<h2>Item not found</h2>';
        return;
    } else {
        $item = getItem($_GET['idItem']);
    ?>
    <main>
        <section class="item-section">
            <div class="img-div">
                <img src="<?php echo $item['picture'] ?>" alt="<?php echo $item['title'] ?>">
            </div>
            <div class="item-info">
                <h1><?php echo $item['title'] ?></h1>
                <p>Preço: <?php echo $item['price'] ?>€</p>
                <p>Tamanha: <?php echo $item['sizeName'] ?></p>
                <p>Categoria: <?php echo $item['categoryName'] ?></p>
                <p>Tipo: <?php echo $item['type_item'] ?></p>
                <p>Color: <?php echo $item['color'] ?></p>
                <p>Condição: <?php echo $item['condition'] ?></p>
                <p>Marca: <?php echo $item['brandName'] ?></p>
                <p>Vendedor: <img src="<?php echo $item['profile_image_link'] ?>"><?php echo $item['username'] ?></p>

                <p>Description: <?php echo $item['description'] ?></p>
                <button class="primary-btn" onclick="buyBtnPressedHandler(<?php echo $_GET['idItem'] ?>);">
                    <img src="../images/icon_btn/cart_plus_solid.svg">
                    Adicionar ao Carrinho
                </button>
            </div>
        </section>
    </main>
<?php }} ?>