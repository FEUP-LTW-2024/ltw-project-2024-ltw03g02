<?php function drawCartMain() { ?>
    <main>
        <h1>O teu carrinho</h1>
        <?php if (empty($_SESSION['cart'])): ?>
        <div class="empty-cart-message">
            <img src="../images/cart_page/empty-cart.png" />
            <h3>O teu carrinho está vazio</h3>
            <p>Adiciona alguns itens ao teu carrinho.</p>
            <a href="filtered_page.php" class="primary-btn">Ir para a loja</a>
        </div>
        <?php else: ?>
            <section class="order">
                <h3>Pedido</h3>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="order-item">
                        <img class="order-item-img" src="<?php echo $item['image']; ?>" />
                        <p class="order-item-name"><?php echo $item['name']; ?></p>
                        <span><?php echo $item['price']; ?> €</span>
                    </div>
                <?php endforeach; ?>
            </section>
            <h2>Subtotal: <span>7,00 €</span></h2>
            <section class="payment">
                <h3>Forma de Pagamento</h3>
                <div class="payment-option">
                    <input type="radio" name="payment" value="mbway" checked>
                    <label>MB WAY</label>
                </div>
                <div class="payment-option">
                    <input type="radio" name="payment" value="multibanco" checked>
                    <label>Multibanco</label>
                </div>
                <div class="payment-option">
                    <input type="radio" name="payment" value="paypal" checked>
                    <label>PayPal</label>
                </div>
            </section>
            <button class="primary-btn">Processar pedido</button>
        <?php endif; ?>
    </main>
<?php } ?>