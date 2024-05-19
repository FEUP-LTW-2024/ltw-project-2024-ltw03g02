<!DOCTYPE html>
<html>
    <head>
        <title>Shipping Form</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../styles/common_style.css">
        <link rel="stylesheet" type="text/css" href="../styles/shipping_form.css">
        <?php include_once('../templates/common/simple_header.php'); ?>
        <?php include_once('../templates/common/footer.php'); ?>
        <?php include_once('../templates/shipping/shipping_form.tpl.php'); ?>

    </head>
    <body>
        <?php drawSimpleHeader(); ?>
        <?php
            require_once('../database/users.db.php');
            $orderId = $_GET['idOrder'];
            $order = getOrder($orderId);
            drawShippingForm($order['idSeller'], $order['idBuyer'], $order['idItem'], $order['paymentOption'], $order['productPrice']);
        ?>
        <?php drawFooter(); ?>
    </body>
</html>