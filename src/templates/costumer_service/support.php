<?php function clientSupport() { ?>
    <section class="support">
        <img src="../images/costumer_service/support.png">
        <h1>Apoio ao cliente</h1>
    </section>
    <section>    
    <form id="client-form" action="/../../actions/action_client.php" method="POST">
        <textarea id="support" name="client_support" rows="15" cols="80" placeholder="Conte-nos, o que precisa?" class="textarea"></textarea>
        <br>
        <input type="submit" value="Enviar" class="primary-btn">
        </form>
    </section>
    <script src="/../../js/form_client.js"></script>
    <div id="success-popup" style="display: none;">
        <p>Form to client support submitted successfully! Soon we'll contact you by email registed in website. Return to the homepage:</p>
        <button id="go-home" class="go-home-btn">Return to Homepage</button>
    </div>
<?php } ?>