<?php function drawSoldItems() {
    require_once('../database/connection.db.php');
    require_once('../templates/common/item_card.php');
    $db = getDatabaseConnection();

    ?>
    <main class="sold-items">
        <h1><?php echo $_SESSION['nome'] ?>'s Sold Items</h1>
        <div class="items">
            <?php
            session_start();
            $stmt = $db->prepare('SELECT * 
                                FROM UserOrder
                                JOIN Item ON UserOrder.idItem = Item.idItem
                                WHERE sellerId = ?');
            $stmt->execute([$_SESSION['idUser']]);
            $orders = $stmt->fetchAll();
            if (count($orders) == 0) {
                echo '<h2>No items sold yet</h2>';
            } else {
                foreach ($orders as $order) {
                    ?>
                        <div class="item-card">
                            <a href="shipping_form.php?idOrder=<?php echo $order['idOrder']; ?>">
                                <img src="<?php echo $order['picture'] ?>" alt="Item Picture">
                            </a>
                            <div class="item-info">
                                <h3><?php echo $order['title'] ?></h3>
                                <p><?php echo $order['price'] ?>€</p>
                            </div>
                        </div>
                    <?php
                }
            }
            ?>
        </div>
    </main>
    <?php
}
?>