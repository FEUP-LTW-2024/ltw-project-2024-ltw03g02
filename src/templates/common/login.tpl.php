<?php
function drawLogin(Session $session) { ?>
    <section id="loginpage">
        <h1>Login</h1>
        <form action = "/../actions/action_login.php" method = "post">
            <label>Username: <input type="text" name="username" value="<?=htmlentities($_SESSION['input']['username login'])?>"></label>
            <label>Password:<input type="password" name="pass" value="<?=htmlentities($_SESSION['input']['pass login'])?>"></label>
            <input id="button" type="submit" value="Entrar">
        </form>
    </section> 
<?php } ?>