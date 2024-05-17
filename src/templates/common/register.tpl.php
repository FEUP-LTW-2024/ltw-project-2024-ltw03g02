<?php
function drawRegister() { 
    $gender = isset($_SESSION['input']['gender newUser']) ? htmlentities($_SESSION['input']['gender newUser']) : 'Male';
?>
    <section id="registerpage">
        <h1>Register</h1>
        <form action = "/../actions/action_register.php" method = "POST">
            <label>Nome: <input type="text" name="nome" value="<?=htmlentities($_SESSION['input']['nome newUser'])?>"></label>
            <label>Username: <input type="text" name="username" value="<?=htmlentities($_SESSION['input']['username newUser'])?>"></label>
            <label>Email: <input type="text" name="email" value="<?=htmlentities($_SESSION['input']['email newUser'])?>"></label>
            <label>Password:<input type="password" name="password1" value="<?=htmlentities($_SESSION['input']['password1 newUser'])?>"></label>
            <label>Confirm Password:<input type="password" name="password2" value="<?=htmlentities($_SESSION['input']['password2 newUser'])?>"></label>
            <label>Gender:
                <input type="radio" name="gender" value="Homem" <?= $gender === 'Homem' ? 'checked' : '' ?>> Homem
                <input type="radio" name="gender" value="Mulher" <?= $gender === 'Mulher' ? 'checked' : '' ?>> Mulher
            </label>
            <label>Address: <input type="text" name="address" value="<?=htmlentities($_SESSION['input']['address newUser'])?>"></label>
            <label>Phone Number: <input type="number" name="phoneNumber" value="<?=htmlentities($_SESSION['input']['phoneNumber newUser'])?>"></label>
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <button type="submit">Register</button>
            <?php
                if (isset($_SESSION['error'])) {
                    echo "<script>alert('".$_SESSION['error']."');</script>";
                    unset($_SESSION['error']);
                }
            ?>
        </form>
    </section> 
<?php } ?>