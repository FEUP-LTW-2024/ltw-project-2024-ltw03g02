<?php function drawSellersPage() { ?>
    <main>
        <section class= "sellers-page">
        <h1>Vendedores</h1>
            <div class="sellers-list">
                <?php
                    require_once("../database/users.db.php");
                    require_once("../database/connection.db.php");
                    require_once("../templates/sellers_page/seller_card.php");
                    $db = getDatabaseConnection(); 
                    $sellers = getAllUsers();
                    foreach ($sellers as $seller) {
                        drawSellerCard($seller['idUser'], $seller['profile_image_link'], $seller['nome'], $seller['username'], $seller['email'], $seller['address'], $seller['rating'], $seller['phoneNumber']);
                    } 
                ?>
            </div>
        </section>
</main>
<?php } ?>