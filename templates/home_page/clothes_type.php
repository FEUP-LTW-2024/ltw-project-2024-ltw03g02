<?php function drawClothesType() { ?>
    <section class="clothes-type">
        <div id="women-card" class="clothes-type-card">
            <img src="../images/home_page/model_women.png" />
            <h3>Mulher</h3>
        </div>
        <div id="men-card" class="clothes-type-card">
            <img src="../images/home_page/model_men.png" />
            <h3>Homem</h3>
        </div>
        <div id="children-card" class="clothes-type-card">
            <img src="../images/home_page/model_children.png" />
            <h3>Criança</h3>
        </div>
    </section>

    <script src="types.js"></script>
<script>
    fetchItemsByType('women-card');
    fetchItemsByType('men-card');
    fetchItemsByType('children-card');
</script>
<?php } ?>