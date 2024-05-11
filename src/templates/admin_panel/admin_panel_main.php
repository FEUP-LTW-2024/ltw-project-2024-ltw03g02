<?php function drawAdminPanelMain(){ ?>
    <?php include_once('table_list.php'); ?>
    <?php include_once('add_row.php'); ?>
    <?php include_once('edit_row.php'); ?>
    <?php
        if (!isset($_GET['state'])){
            $state = 'users';
        } else {
            $state = $_GET['state'];
        } 
    ?>
    <main>
        <h1>Admin Panel</h1>
        <nav>
            <ul>
                <li class="<?= $state == 'users' ? 'selected' : '' ?>">
                    <a href="admin_panel.php?state=users">Users</a>
                </li>
                <li class="<?= $state == 'products' ? 'selected' : '' ?>">
                    <a href="admin_panel.php?state=products">Products</a>
                </li>
                <li class="<?= $state == 'categories' ? 'selected' : '' ?>">
                    <a href="admin_panel.php?state=categories">Categories</a>
                </li>
            </ul>
        </nav>
        <?php
            if (!isset($_GET['state'])){
                $state = 'users';
            } else {
                $state = $_GET['state'];
            }
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