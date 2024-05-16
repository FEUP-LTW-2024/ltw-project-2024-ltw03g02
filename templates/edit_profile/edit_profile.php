<?php function drawEditProfile() { ?>
    <section id="edit-profile">
        <h2>Editar perfil</h2>
        <form id="edit-profile-form" action="../actions/action_edit_profile.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="nome">Novo nome</label>
                <input type="text" name="nome" class="nome-input" value="<?php echo $_SESSION['nome']; ?>" required>
            </div>
            <div>
                <label for="username">Novo username</label>
                <input type="text" name="username" class="username-input" required>
            </div>            

            <div>
                <label for="email">Novo email</label>
                <input type="text" name="email" class="email-input" required>
            </div>
            
            <div>
                <label for="pass">Nova password</label>
                <input type="text" name="pass" class="pass-input" required>
            </div>

            <div>
                <label for="gender">Novo gênero</label>
                <input type="text" name="gender" class="gender-input" required>
            </div>

            <div>
                <label for="address">Novo endereço</label>
                <input type="text" name="address" class="address-input" required>
            </div>

            <div>
                <label for="profile_image_link">Nova foto de perfil</label>
                <input type="file" name="profile_image_link" class="profile_image_link-input" accept="image/*" required>
            </div>

            <div>
                <label for="phoneNumber">Novo contacto</label>
                <input type="text" name="phoneNumber" class="phoneNumber-input" required>
            </div>

            <button class="primary-btn" type="submit">Salvar mudanças</button>

        </form>
    </section>
<?php } ?>