<?php function clientSupport() { ?>
    <section class="support">
        <img src="../images/costumer_service/support.png">
        <h1>Apoio ao cliente</h1>    
        <form id="client-form" action="/../../actions/action_client.php" method="POST">
            <textarea id="support" name="client_support" rows="15" cols="80" placeholder="Descreve a tua dúvida detalhadamente..." class="textarea"></textarea>
            <br>
            <input type="submit" value="Enviar" class="primary-btn">
        </form>
        <script src="/../../js/form_client.js"></script>
        <div id="success-popup" style="display: none;">
            <p>Form to client support submitted successfully! Soon we'll contact you by email registed in website. Return to the homepage:</p>
            <button id="go-home" class="primary-btn">Return to Homepage</button>
        </div>
    </section>
<?php } ?>