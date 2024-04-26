<?php 
  require_once(dirname(__DIR__).'/../classes/session.class.php');
  $session = new Session();

  function displayUserIconOrLogin() {
    global $session;
    if ($session->isLoggedIn()) {
      $user = $session->getUser();
      echo '<img src="' . $user['profile_image_link'] . '" alt="Profile Icon">';
    } else {
      echo '<button class="primary-btn">Iniciar Sessão</button>';
    }
  }

  function drawHeader() { ?>
    <?php include_once('logo.php'); ?>
    <header>
        <div class="topbar">
            <a href="../../pages/home_page.php">
                <img src="../../images/logo.png" />
            </a>
            <div class="topbar-right-items">
                <form action="/search" method="get">
                    <input type="search" name="q" placeholder="Procure por vendedor, marca, produto...">
                </form>
                <?php displayUserIconOrLogin(); ?>
                <a href="cart_page.php" class="cart-btn">
                    <span>0</span>
                    <img src="../images/shopping_cart.png" />
                </a>
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

