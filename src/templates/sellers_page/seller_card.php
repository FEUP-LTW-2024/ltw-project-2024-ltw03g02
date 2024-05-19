<?php function drawSellerCard($id, $profile_image_link, $nome, $username, $email, $address, $rating, $contact) { ?>
    <div class="seller-card">
        <h3 class="username-info"><?php echo $username ?></h3>
        <img src="<?php echo $profile_image_link; ?>" />
        <div class="seller-card-info">
            <span class="nome-info"><?php echo $nome ?></span>
            <div class="rating-info">
                <img src="../../images/icon_btn/star_solid.svg">
                <span><?php echo $rating ?></span>
            </div>
            <div class="contact-info">
                <div class="phone-info">
                    <img src="../../images/icon_btn/phone_solid.svg">
                    <span><?php echo $contact ?></span>
                </div>
                <div class="email-info">
                    <img src="../../images/icon_btn/email_solid.svg">
                    <span><?php echo $email ?></span>
                </div>
                <div class="address-info">
                    <img src="../../images/icon_btn/address_solid.svg">
                    <span><?php echo $address ?></span>
                </div>
            </div>
        </div>
        <div class="seller-btn-box">
            <a href="filtered_page.php?page=loja&searchTerm=<?php echo $username ?>">
                <button class="primary-btn">Ver Produtos</button>
            </a>
        </div>
    </div>
<?php } ?>