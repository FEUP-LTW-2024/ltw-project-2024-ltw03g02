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
                <li class="<?= $state == 'items' ? 'selected' : '' ?>">
                    <a href="admin_panel.php?state=items">Items</a>
                </li>
                <li class="<?= $state == 'categories' ? 'selected' : '' ?>">
                    <a href="admin_panel.php?state=categories">Categories</a>
                </li>
            </ul>
        </nav>
        <?php
            require_once(dirname(__DIR__) . '/../database/admin.db.php');

            if (!isset($_GET['state'])){
                $state = 'users';
            } else {
                $state = $_GET['state'];
            }

            if ($state == 'users'){
                $users = getUsers();
                drawList($users, 'idUser');
                drawAddUser();
                drawEditUser();

            } elseif ($state == 'items'){
                $items = getItems();
                drawList($items, 'idItem');
                drawAddRow($items, 'idItem', '../../actions/admin_panel/action_add_item.php');
                // drawEditRow();

            } elseif ($state == 'categories') {
                $categories = getCategories();
                drawList($categories, 'idCategory');
                // drawAddRow();
                // drawEditRow();
            }
        ?>
    </main>
<?php } ?>