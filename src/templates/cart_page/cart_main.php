<?php 
require_once(dirname(__DIR__) . '/../templates/common/icon_btn.php');
function drawCartMain() { ?>
    <main>
        <h1>O teu carrinho</h1>
        <?php
            session_start();
            if (!isset($_SESSION['cart']) or !count($_SESSION['cart'])): ?>
                <div class="empty-cart-message">
                    <img src="../images/cart_page/empty-cart.png" />
                    <h3>O teu carrinho está vazio</h3>
                    <p>Adiciona alguns itens ao teu carrinho.</p>
                    <a href="filtered_page.php" class="primary-btn">Ir para a loja</a>
                </div>
        <?php else: ?>
            <section class="order">
                <h3>Pedido</h3>
                <?php
                require_once('../database/cart.db.php');
                $cart = $_SESSION['cart'];
                $items = getCartItems($cart);
                $subtotal = 0;
                foreach ($items as $index => $item): ?>
                    <div class="order-item">
                        <img class="order-item-img" src="<?php echo $item['picture']; ?>" />
                        <div class="order-item-name">
                            <p><?php echo $item['title']; ?></p>
                        </div>
                        <div class="price-box">
                            <span><?php echo $item['price']; ?> €</span>
                        </div>
                        <div class="delete-box">
                            <?php drawDeleteBtnWithId($index); ?>
                        </div>
                    </div>
                <?php
                    $subtotal += $item['price']; 
                    endforeach; 
                ?>
            </section>
            <h2>Subtotal: <span><?php echo $subtotal; ?> €</span></h2>
            <form id="purchase-form" action="../actions/action_purchase.php" method="post">
                <h3>Forma de Pagamento</h3>
                <input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>">
                <input type="hidden" name="items" value="<?php echo json_encode($cart); ?>">
                <div class="payment-option">
                    <input type="radio" name="paymentOption" value="mbway" checked>
                    <label>MB WAY</label>
                </div>
                <div class="payment-option">
                    <input type="radio" name="paymentOption" value="multibanco" checked>
                    <label>Multibanco</label>
                </div>
                <div class="payment-option">
                    <input type="radio" name="paymentOption" value="paypal" checked>
                    <label>PayPal</label>
                </div>
            <button id="process-payment" class="primary-btn">Processar pedido</button>
            </form>
        <?php endif; ?>
    </main>
<?php } ?>