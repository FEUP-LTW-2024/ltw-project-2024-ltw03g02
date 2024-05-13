<?php function drawHeader() { ?>
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
        <?php
            $page = isset($_GET['page']) ? $_GET['page'] : '';
        ?>
        <nav>
            <ul>
                <li <?php echo ($page == 'Sobre Nós') ? 'class="selected"' : ''; ?>><a href="#">Sobre Nós</a></li>
                <li <?php echo ($page == 'loja') ? 'class="selected"' : ''; ?>><a href="../../pages/filtered_page.php?page=loja">Loja</a></li>
                <li <?php echo ($page == 'novidades') ? 'class="selected"' : ''; ?>><a href="../../pages/filtered_page.php?page=novidades">Novidades</a></li>
                <li <?php echo ($page == 'Vendedores') ? 'class="selected"' : ''; ?>><a href="#">Vendedores</a></li>
                <li <?php echo ($page == 'admin_panel') ? 'class="selected"' : ''; ?>><a href="../../pages/admin_panel.php?page=admin_panel">Admin Panel</a></li>
            </ul>
        </nav>
    </header>
<?php } ?>

