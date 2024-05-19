<?php function drawHero() { ?>
    <section class="hero">
        <img src="../images/home_page/hero_image.png">
        <p>ARMÁRIO A ABARROTAR?<br>
        AQUI ENCONTRAS A SOLUÇÃO PERFEITA PARA O ESVAZIARES!</p>
        
        <?php if (isset($_SESSION['idUser'])): ?>
            <a href="list_item_page.php"><button class="primary-btn">VENDE AGORA!</button></a>
        <?php else: ?>
            <a href="login.php"><button class="primary-btn">VENDE AGORA!</button></a>
        <?php endif; ?>
        
        <h1>USE or SELL</h1>
    </section>
<?php } ?>