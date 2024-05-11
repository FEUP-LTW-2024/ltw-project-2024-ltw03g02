<?php function drawEditUser() { ?>
    <section id="edit-user-section">
        <h2>Edit User</h2>
        <form id="edit-user-form" action="../actions/action_edit_user.php" method="post">
            <div>
                <label for="idUser">Id</label>
                <input id="idUser-input-edit" type="text" name="idUser" class="input-edit-user idUser-input" required>
            </div>
            <div>
                <label for="nome">Name</label>
                <input type="text" name="nome" class="input-edit-user nome-input" required>
            </div>
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" class="input-edit-user username-input" required>
            </div>            

            <div>
                <label for="email">Email</label>
                <input type="text" name="email" class="input-edit-user email-input" required>
            </div>
            
            <div>
                <label for="pass">Password</label>
                <input type="text" name="pass" class="input-edit-user pass-input" required>
            </div>

            <div>
                <label for="gender">Gender</label>
                <input type="text" name="gender" class="input-edit-user gender-input" required>
            </div>

            <div>
                <label for="address">Address</label>
                <input type="text" name="address" class="input-edit-user address-input" required>
            </div>

            <div>
                <label for="profile_image_link">Profile Image</label>
                <input type="text" name="profile_image_link" class="input-edit-user profile_image_link-input" required>
            </div>

            <div>
                <label for="phoneNumber">Phone Number</label>
                <input type="text" name="phoneNumber" class="input-edit-user phoneNumber-input" required>
            </div>
            
            <div>
                <label for="is_admin">Is Admin (0 or 1)</label>
                <input type="text" name="is_admin" class="input-edit-user is_admin-input" required>
            </div>

            <button class="primary-btn" type="submit">Edit User</button>
        </form>
    </section>
<?php } ?>