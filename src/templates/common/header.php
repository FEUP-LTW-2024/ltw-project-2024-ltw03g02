<?php function drawHeader() { ?>
    <?php include_once('logo.php');
    include_once('/../classes/session.class.php'); ?>
    <header>
        <div class="topbar">
            <a href="../../pages/home_page.php">
                <img src="../../images/logo.png" />
            </a>
            <div class="topbar-right-items">
                <form action="/search" method="get">
                    <input type="search" name="q" placeholder="Procure por vendedor, marca, produto...">
                </form>
                <a href="login.php" class="login-btn">
                    <button class="primary-btn">Iniciar Sessão</button>
                </a>
                <a href="cart_page.php" class="cart-btn">
                    <img src="/../images/shopping_cart.png" />
                </a>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="#">Sobre Nós</a></li>
                <li><a href="../../pages/filtered_page.php">Loja</a></li>
                <li><a href="../../pages/filtered_page.php">Novidades</a></li>
                <li><a href="#">Vendedores</a></li>
                <li><a href="#">Promoções</a></li>
            </ul>
        </nav>
    </header>
<?php } ?>

