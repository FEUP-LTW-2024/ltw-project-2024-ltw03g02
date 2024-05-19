<?php
    function drawPersonInfo($idUser) {
        require_once('../database/users.db.php');
        $user = getUser($idUser);
        ?>
            <div class="person-info info-box">
                <div>
                    <p>Nome:</p>
                    <p><?php echo $user['nome'] ?></p>
                </div>
                <div>
                    <p>Morada:</p>
                    <p><?php echo $user['address'] ?></p>
                </div>
                <div>
                    <p>Telefone:</p>
                    <p><?php echo $user['phoneNumber'] ?></p>
                </div>
                <div>
                    <p>Email:</p>
                    <p><?php echo $user['email'] ?></p>
                </div>
            </div>
        <?php
    }
?>

<?php function printItemCard($idItem) { 
    require_once('../database/items.db.php');
    $item = getItem($idItem);
    ?>
    <div class="item-card">
        <img src="<?php echo $item['picture'] ?>" alt="Imagem do produto">
        <div class="item-info">
            <h2><?php echo $item['title'] ?></h2>
            <p><?php echo $item['description'] ?></p>
            <p><?php echo $item['price'] ?>€</p>
        </div>
    </div>
    <?php } ?>

<?php function drawShippingForm($sellerId, $buyerId, $idItem, $paymentOption, $price) {

    ?>
    <h1>Informações de envio</h1>
    <div class="shipping-form">
        <div class="product">
            <h2>Produto</h2>
            <div class="product-info info-box">
                <?php
                    printItemCard($idItem);
                ?>
            </div>
            <h2>Pagamento</h2>
            <div class="payment-info info-box">
                <p>Opção de pagamento: <?php echo $paymentOption ?></p>
                <p>Preço: <?php echo $price ?>€</p>
            </div>
        </div>
        <div class ="people">
            <div class="sender">
                <h2>Remetente</h2>
                <?php drawPersonInfo($sellerId) ?>
            </div>
            <div class="receiver">
                <h2>Destinatário</h2>
                <?php drawPersonInfo($buyerId) ?>
            </div>
        </div>
    </div>
<?php } ?>    