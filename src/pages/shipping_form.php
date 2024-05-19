<!DOCTYPE html>
<html>
    <head>
        <title>Shipping Form</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../styles/common_style.css">
        <link rel="stylesheet" type="text/css" href="../styles/shipping.css">
        <?php include_once('../templates/common/header.php'); ?>
        <?php include_once('../templates/common/footer.php'); ?>
        <?php include_once('../templates/shipping/shipping_form.tpl.php'); ?>

    </head>
    <body>
        <?php drawHeader(); ?>
        <?php shippingForm(); ?>
        <?php drawFooter(); ?>
    </body>
</html>