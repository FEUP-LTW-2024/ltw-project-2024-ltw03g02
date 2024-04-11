<?php function drawHeader() { ?>
    <header>
        <div class="topbar">
            <img src="../images/logo.png" />
            <div class="topbar-right-items">
                <form action="/search" method="get">
                    <input type="search" name="q" placeholder="Procure por vendedor, marca, produto...">
                </form>
                <button class="primary-btn">Iniciar Sessão</button>
                <div class="cart-btn">
                    <span>0</span>
                    <img src="../images/shopping_cart.png" />
                </div>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="#">Sobre Nós</a></li>
                <li><a href="#">Loja</a></li>
                <li><a href="#">Novidades</a></li>
                <li><a href="#">Vendedores</a></li>
                <li><a href="#">Promoções</a></li>
            </ul>
        </nav>
    </header>
<?php } ?>

