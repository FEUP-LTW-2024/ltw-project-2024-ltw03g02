<?php function drawCartMain() { ?>
    <main>
        <h1>O teu carrinho</h1>
        <section class="order">
            <h3>Pedido</h3>
            <div class="order-item" >
                <img class="order-item-img" src="../../images/cart_page/tshirt_short_sleeves.png" />
                <p class="order-item-name">T-shirt manga curta</p>
                <span>7,00 €</span>
            </div>
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
    </main>
<?php } ?>