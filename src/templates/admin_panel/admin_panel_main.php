<?php function drawAdminPanelMain(){ ?>
    <?php include_once('users_list.php'); ?>
    <?php include_once('add_user.php'); ?>
    <?php include_once('edit_user.php'); ?>
    <main>
        <h1>Admin Panel</h1>
        <?php drawUsersList(); ?>
        <?php drawAddUser(); ?>
        <?php drawEditUser(); ?>
    </main>
<?php } ?>