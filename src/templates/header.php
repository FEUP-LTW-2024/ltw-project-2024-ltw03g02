<?php function drawHeader() { ?>
    <header>
        <img src="../images/logo.png" />
        <form action="/search" method="get">
            <input type="search" name="q" placeholder="Search...">
        </form>
        <button>Iniciar Sessão</button>
        <div>
            <span>0</span>
            <img src="../images/shopping_cart.png" />
        <nav>
            <ul>
                <li><a href="#">Sobre nós</a></li>
                <li><a href="#">Loja</a></li>
                <li><a href="#">Novidades</a></li>
                <li><a href="#">Vendedores</a></li>
                <li><a href="#">Promoções</a></li>
            </ul>
        </nav>
    </header>
<?php } ?>

