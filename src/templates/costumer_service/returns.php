<?php function returns() { ?>
    <div class="returns">
        <h1>Devoluções</h1>
        <section class="instructions">
            <p>Se a compra realizada não correspondeu às suas expectativas, oferecemos-lhe a possibilidade de fazer a devolução.</p>
            <p>Efetue a sua devolução num prazo máximo de 30 dias após a compra.</p>
            <p>Serás responsável por tratar da devolução e suportar os custos de envio.</p>
        </section>
        <section class="instructions">
            <h2>Como devolver?</h2>
            <ol>
                <li>Embale o artigo devidamente.</li>
                <li>Coloque a etiqueta junto da encomenda e envie a partir de uma transportadora ou serviço de envio.</li>
                <li>Partilhe com o vendedor o número de seguimento do envio e aguarde pela entrega da encomenda e posterior devolução do valor.</li>
                <li>Crie uma etiqueta de envio com o número de seguimento do envio e os nomes e moradas do remetente e do destinatário bem visíveis.</li>
                <li>Implemente isso tudo na caixa de texto abaixo, para que fiquemos iterados da situação! </li>
            </ol>
        </section>
        <section>
            <form id="devolution-form" action="/../../actions/action_devolution.php" method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf']; ?>">
                <textarea id="support" name="client_support" rows="15" cols="80" placeholder="Explica tudo detalhadamente aqui acerca do produto, da entrega e do vendedor (qualidade do produto, qualidade de entrega, preço, nome do produto, etc) ..." class="textarea"></textarea>
                <br>
                <input type="submit" value="Enviar" class="primary-btn">
            </form>
        </section>
        <script src="/../../js/form_devolution.js"></script>
        <div id="success-popup" style="display: none;">
            <p>Form to devolution of an item submitted successfully! Return to the homepage:</p>
            <button id="go-home" class="go-home-btn">Return to Homepage</button>
        </div>
    </div>
<?php } ?>