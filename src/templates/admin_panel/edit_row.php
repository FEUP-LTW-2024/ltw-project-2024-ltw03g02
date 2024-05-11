<?php function drawEditUser() { ?>
    <section id="edit-row-section">
        <h2>Edit User</h2>
        <form id="edit-user-form" action="../actions/admin_panel/action_edit_user.php" method="post">
            <div>
                <label for="idUser">Id</label>
                <input id="id-input-edit" type="text" name="idUser" class="input-edit-row idUser-input" required>
            </div>
            <div>
                <label for="nome">Name</label>
                <input type="text" name="nome" class="input-edit-row nome-input" required>
            </div>
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" class="input-edit-row username-input" required>
            </div>            

            <div>
                <label for="email">Email</label>
                <input type="text" name="email" class="input-edit-row email-input" required>
            </div>
            
            <div>
                <label for="pass">Password</label>
                <input type="text" name="pass" class="input-edit-row pass-input" required>
            </div>

            <div>
                <label for="gender">Gender</label>
                <input type="text" name="gender" class="input-edit-row gender-input" required>
            </div>

            <div>
                <label for="address">Address</label>
                <input type="text" name="address" class="input-edit-row address-input" required>
            </div>

            <div>
                <label for="profile_image_link">Profile Image</label>
                <input type="text" name="profile_image_link" class="input-edit-row profile_image_link-input" required>
            </div>

            <div>
                <label for="phoneNumber">Phone Number</label>
                <input type="text" name="phoneNumber" class="input-edit-row phoneNumber-input" required>
            </div>
            
            <div>
                <label for="is_admin">Is Admin (0 or 1)</label>
                <input type="text" name="is_admin" class="input-edit-row is_admin-input" required>
            </div>

            <button class="primary-btn" type="submit">Edit User</button>
        </form>
    </section>
<?php } ?>

<?php 
    function drawEditRow($table, $primaryKey, $action) { 
        if (count($table) > 0) {
            $columns = array_keys($table[0]);
        ?>
        <section id="edit-row-section">
            <h2>Edit <?php echo ucfirst(str_replace('id', '', $primaryKey)); ?></h2>
            <form id="edit-row-form" class="input-edit-row" action="<?php echo $action ?>" method="post">
                <div>
                    <label for="<?php echo $primaryKey; ?>">Id</label>
                    <input type="text" name="<?php echo $primaryKey; ?>" id="id-input-edit" required>
                </div>
                <?php
                    foreach ($columns as $column) {
                        if ($column != $primaryKey) {
                ?>
                <div>
                    <label for="<?php echo $column; ?>"><?php echo $column; ?></label>
                    <input type="text" name="<?php echo $column; ?>" id="<?php echo $column; ?>-input" class="input-edit-row" required>
                </div>
                <?php
                        }
                    }
                ?>
                <button class="primary-btn" type="submit">
                    Edit <?php echo ucfirst(str_replace('id', '', $primaryKey)); ?>
                </button>
            </form>
        </section>
        <?php 
        }
    } 
?>