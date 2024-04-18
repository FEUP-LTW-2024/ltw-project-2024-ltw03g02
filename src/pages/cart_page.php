<!DOCTYPE html>
<html>
    <head>
        <title>Clothes Cachet - USE or SELL</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../styles/common_style.css">
        <link rel="stylesheet" type="text/css" href="../styles/cart_page.css">
        <?php include_once('../templates/cart_page/cart_header.php'); ?>
        <?php include('../templates/common/logo.php'); ?>
        <?php include_once('../templates/common/footer.php'); ?>
    </head>
    <body>
        <?php drawCartHeader(); ?>

        <main>
            <h1>O teu carrinho</h1>
            <section class="order">
                <h3>Pedido</h3>
                <img src="../images/clothes/t-shirt.png" />
                <p>T-shirt manga curta</p>
                <span>7,00€</span>
            </section>
            <h2>Subtotal: 7,00€</h2>
            <section class="delivery">
                <h3>Entrega</h3>
                <div class="delivery-option">
                    <input type="radio" name="delivery" value="ponto-recolha" checked>
                    <img src="">
                    <label>Entrega em ponto de recolha</label>
                    <span>a partir de 2,60€</span>
                </div>
                <div class="delivery-option">
                    <input type="radio" name="delivery" value="casa" checked>
                    <img src="">
                    <label>Entrega em casa</label>
                    <p>Rua Doutor Manuel Pereira da Silva 236</p>
                    <span>3,10€</span>
                </div>
            </section>
        </main>
        
        <?php drawFooter(); ?>
    </body>
</html>