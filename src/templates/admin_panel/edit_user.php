<?php function drawEditUser() { ?>
    <section id="edit-user-section">
        <h2>Edit User</h2>
        <form id="edit-user-form" action="../actions/action_edit_user.php" method="post">
            <div>
                <label for="idUser">Id</label>
                <input id="idUser-input-edit" type="text" name="idUser" class="idUser-input" required>
            </div>
            <div>
                <label for="nome">Name</label>
                <input type="text" name="nome" class="nome-input" required>
            </div>
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" class="username-input" required>
            </div>            

            <div>
                <label for="email">Email</label>
                <input type="text" name="email" class="email-input" required>
            </div>
            
            <div>
                <label for="pass">Password</label>
                <input type="text" name="pass" class="pass-input" required>
            </div>

            <div>
                <label for="gender">Gender</label>
                <input type="text" name="gender" class="gender-input" required>
            </div>

            <div>
                <label for="address">Address</label>
                <input type="text" name="address" class="address-input" required>
            </div>

            <div>
                <label for="profile_image_link">Profile Image</label>
                <input type="text" name="profile_image_link" class="profile_image_link-input" required>
            </div>

            <div>
                <label for="phoneNumber">Phone Number</label>
                <input type="text" name="phoneNumber" class="phoneNumber-input" required>
            </div>
            
            <div>
                <label for="is_admin">Is Admin</label>
                <input type="text" name="is_admin" class="is_admin-input" required>
            </div>

            <button class="primary-btn" type="submit">Edit User</button>
        </form>
    </section>
<?php } ?>