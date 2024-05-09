<?php 
    function getUsers() {
        require_once(dirname(__DIR__) . '/../database/connection.db.php');
        $db = getDatabaseConnection();
        $stmt = $db->prepare('SELECT *
                                FROM User;');
        $stmt->execute();
        $users = $stmt->fetchAll();
        return $users;
    }
?>

<?php function drawUsersList(){ ?>
    <section class="users-list">
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
                    $users = getUsers();

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
                            <td><?php drawDeleteBtn(); ?></td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </section>
<?php } ?>