<?php function drawUsersList(){ 
    require_once(dirname(__DIR__) . '/../database/users.db.php');
    $users = getUsers();
?>
    <section class="table-list">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Profile Image</th>
                    <th>Phone Number</th>
                    <th>Is Admin</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($users as $user) {
                        ?>
                        <tr>
                            <td><?php echo $user['idUser']; ?></td>
                            <td><?php echo $user['nome']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['pass']; ?></td>
                            <td><?php echo $user['gender']; ?></td>
                            <td><?php echo $user['address']; ?></td>
                            <td><?php echo $user['profile_image_link']; ?></td>
                            <td><?php echo $user['phoneNumber']; ?></td>
                            <td><?php echo $user['is_admin']; ?></td>
                            <td><?php drawEditBtnWithId($user['idUser']); ?></td>
                            <td><?php drawDeleteBtnWithId($user['idUser']); ?></td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </section>
<?php } ?>

<?php function drawList($table, $primaryKey){ ?>
    <section class="table-list">
        <table>
            <thead>
                <tr>
                    <?php
                        if (count($table) > 0) {
                            $columns = array_keys($table[0]);
                            foreach ($columns as $column) {
                                ?>
                                    <th><?php echo $column; ?></th>
                                <?php
                            }
                        }
                    ?>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($table as $row) {
                        ?>
                        <tr>
                            <?php
                                foreach ($row as $key => $value) {
                                    ?>
                                        <td><?php echo $value; ?></td>
                                    <?php
                                }
                            ?>
                            <td><?php drawEditBtnWithId($row[$primaryKey]); ?></td>
                            <td><?php drawDeleteBtnWithId($row[$primaryKey]); ?></td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </section>
<?php } ?>