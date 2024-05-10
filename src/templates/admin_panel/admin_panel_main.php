<?php function drawAdminPanelMain(){ ?>
    <?php include_once('users_list.php'); ?>
    <?php include_once('add_user.php'); ?>
    <?php include_once('edit_user.php'); ?>
    <main>
        <h1>Admin Panel</h1>
        <?php
            $state = 'users';
            if ($state == 'users'){
                drawUsersList();
                drawAddUser();
                drawEditUser();
            } elseif ($state == 'products'){
                drawProductsList();
                drawAddProduct();
                drawEditProduct();
            } elseif ($state == 'categories') {
                drawCategoriesList();
                drawAddCategory();
                drawEditCategory();
            }
        ?>
    </main>
<?php } ?>