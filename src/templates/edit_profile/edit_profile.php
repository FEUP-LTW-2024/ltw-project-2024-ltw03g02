<?php
 function drawEditProfile() { ?>
    <section id="edit-profile">
        <h2>Editar perfil</h2>
        <form id="edit-profile-form" action="../../actions/action_edit_profile.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="nome">Novo nome</label>
                <input type="text" name="nome" class="nome-input" value="<?php echo $_SESSION['nome']; ?>" required>
            </div>
            <div>
                <label for="username">Novo username</label>
                <input type="text" name="username" class="username-input" value="<?php echo $_SESSION['username']; ?>"required>
            </div>            

            <div>
                <label for="email">Novo email</label>
                <input type="text" name="email" class="email-input" value="<?php echo $_SESSION['email']; ?>"required>
            </div>
            
            <div>
                <label for="pass">Nova password (insira a antiga se não quiser alterar)</label>
                <input type="password" name="pass" class="pass-input" required>
            </div>

            <div>
                <label for="gender">Novo gênero</label>
                <input type="text" name="gender" class="gender-input" value="<?php echo $_SESSION['gender']; ?>"required>
            </div>

            <div>
                <label for="address">Novo endereço</label>
                <input type="text" name="address" class="address-input" value="<?php echo $_SESSION['address']; ?>"required>
            </div>

            <div>
                <label for="profile_image_link">Nova foto de perfil (link)</label>
                <input type="text" name="profile_image_link" class="profile_image_link-input" value="<?php echo $_SESSION['photo']; ?>"required>
            </div>

            <div>
                <label for="phoneNumber">Novo contacto</label>
                <input type="text" name="phoneNumber" class="phoneNumber-input" value="<?php echo $_SESSION['phoneNumber']; ?>"required>
            </div>

            <input type="submit" value="Salvar mudanças" class="primary-btn">
        </form>
    </section>
<?php } ?>