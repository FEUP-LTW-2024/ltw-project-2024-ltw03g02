<?php 
    declare(strict_types = 1);
function drawMessages(Session $session) { ?>
    <section id="messages">
    <?php foreach ($session->getMessages() as $message) { ?>
        <article class="<?=$message['type']?>">
        <i class='fas fa-exclamation-circle'></i>
        <?=$message['text']?>
        </article>
    <?php } ?> </section> 
<?php 
}

function drawAcessDenied() { ?>
    <section id="accessDenied">
        <h2>Voltar para a <a href="../pages/index.php">página principal</a></h2>  
    </section> 
<?php } 
?>