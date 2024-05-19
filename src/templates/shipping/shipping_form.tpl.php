<?php function shippingForm() {
    require_once('../templates/common/header.php');
    require_once('../database/item.db.php');
    require_once('../api/item.api.php');
    require_once('../api/user.api.php');
    require_once('../classes/user.class.php');
    require_once('../classes/item.class.php');
    require_once('../classes/session.class.php');

    $db = getDatabaseConnection();
    $stmt = $db->prepare('SELECT * FROM User WHERE idUser = :idUser');
    $stmt->bindParam(':idUser', $_SESSION['idUser']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $db->prepare('SELECT * FROM UserOrder, Item WHERE Item.sellerId = :idUser AND UserOrder.idItem = Item.idItem AND UserOrder.state = "Vendido"');
    $stmt->bindParam(':idUser', $_SESSION['idUser']);
    $stmt->execute();
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
    
?>    

<?php
    if ($order) {
        // Get the user and item information
        $stmt = $db->prepare('SELECT User.nome, User.address, User.phoneNumber, User.email, Item.title FROM User, Item WHERE User.idUser = :idUser AND Item.idItem = :idItem');
        $stmt->bindParam(':idUser', $order['idUser']);
        $stmt->bindParam(':idItem', $order['idItem']);
        $stmt->execute();
        $info = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="shipping-form-container">
        <h1>Shipping Form</h1>
        <form id="shipping-form" action="/../../actions/action_insert_shipping.php" method="POST">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo $info['nome']; ?>" required>
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="<?php echo $info['address']; ?>" required>
            <label for="phoneNumber">Phone Number</label>
            <input type="text" id="phoneNumber" name="phoneNumber" value="<?php echo $info['phoneNumber']; ?>" required>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="<?php echo $info['email']; ?>" required>
            <label for="item">Item</label>
            <input type="text" id="item" name="item" value="<?php echo $info['title']; ?>" required>
            <input type="submit" value="Submit" class="primary-btn">
        </form>
    </div>

    <?php
    } else {
        //show item normally
        echo "There are no sold items.";
    }
    ?>
<?php } ?>    