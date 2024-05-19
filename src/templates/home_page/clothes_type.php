<?php function drawClothesType() { ?>
    <section class="clothes-type">
        <a href="filtered_page.php?page=loja&type_item=Mulher"><div id="women-card" class="clothes-type-card">
            <img src="../images/home_page/model_women.png" />
            <h3>Mulher</h3>
        </div></a>
        <a href="filtered_page.php?page=loja&type_item=Homem"><div id="men-card" class="clothes-type-card">
            <img src="../images/home_page/model_men.png" />
            <h3>Homem</h3>
        </div></a>
        <a href="filtered_page.php?page=loja&type_item=Criança"><div id="children-card" class="clothes-type-card">
            <img src="../images/home_page/model_children.png" />
            <h3>Criança</h3>
        </div></a>
    </section>
<?php } ?>