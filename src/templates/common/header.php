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


                <?php 
                session_start();
                if (!isset($_SESSION['idUser'])): ?>
                    <a href="login.php" class="login-btn">
                        <button class="primary-btn">Iniciar Sessão</button>
                    </a>
                <?php else: ?>
                    <a href="../../pages/profile_page.php">
                        <img id="profile_img_link" src="<?php echo $_SESSION['photo']; ?>">
                    </a>
                    <a href="../../actions/action_logout.php" class="login-btn">
                        <button class="primary-btn">Terminar Sessão</button>
                    </a>
                <?php endif; ?>

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
                <?php if ($_SESSION['is_admin'] == "Yes"): ?>
                    <li <?php echo ($page == 'admin_panel') ? 'class="selected"' : ''; ?>><a href="../../pages/admin_panel.php?page=admin_panel">Admin Panel</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
<?php } ?>

