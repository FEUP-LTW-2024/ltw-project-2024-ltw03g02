<?php function drawAdminPanelMain(){ ?>
    <?php include_once('users_list.php'); ?>
    <?php include_once('add_user.php'); ?>
    <main>
        <h1>Admin Panel</h1>
        <?php drawUsersList(); ?>
        <?php drawAddUser(); ?>
    </main>
<?php } ?>