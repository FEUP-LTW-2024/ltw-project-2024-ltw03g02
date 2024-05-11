<?php function drawAddUser() { ?>
    <section id="add-row-section">
        <h2>Add New User</h2>
        <form id="add-row-form" action="../actions/admin_panel/action_add_user.php" method="post">
            <div>
                <label for="nome">Name</label>
                <input type="text" name="nome" id="nome-input" required>
            </div>
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username-input" required>
            </div>            

            <div>
                <label for="email">Email</label>
                <input type="text" name="email" id="email-input" required>
            </div>
            
            <div>
                <label for="pass">Password</label>
                <input type="text" name="pass" id="pass-input" required>
            </div>

            <div>
                <label for="gender">Gender</label>
                <input type="text" name="gender" id="gender-input" required>
            </div>

            <div>
                <label for="address">Address</label>
                <input type="text" name="address" id="address-input" required>
            </div>

            <div>
                <label for="profile_image_link">Profile Image</label>
                <input type="text" name="profile_image_link" id="profile_image_link-input" required>
            </div>

            <div>
                <label for="phoneNumber">Phone Number</label>
                <input type="text" name="phoneNumber" id="phoneNumber-input" required>
            </div>
            
            <div>
                <label for="is_admin">Is Admin (0 or 1)</label>
                <input type="text" name="is_admin" id="is_admin-input" required>
            </div>

            <button class="primary-btn" type="submit">Add User</button>
        </form>
    </section>
<?php } ?>

<?php 
    function drawAddRow($table, $primaryKey, $action) { 
        if (count($table) > 0) {
            $columns = array_keys($table[0]);
        ?>
        <section id="add-row-section">
            <h2>Add New Item</h2>
            <form id="add-row-form" action="<?php echo $action ?>" method="post">
                <?php
                    foreach ($columns as $column) {
                        if ($column != $primaryKey) {
                ?>
                <div>
                    <label for="<?php echo $column; ?>"><?php echo $column; ?></label>
                    <input type="text" name="<?php echo $column; ?>" id="<?php echo $column; ?>-input" required>
                </div>
                <?php
                        }
                    }
                ?>
                <button class="primary-btn" type="submit">
                    Add <?php echo ucfirst(str_replace('id', '', $primaryKey)); ?>
                </button>
            </form>
        </section>
        <?php 
        }
    } 
?>