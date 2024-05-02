<!DOCTYPE html>
<html>
    <head>
        <title>Clothes Cachet - USE or SELL</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../styles/common_style.css">
        <link rel="stylesheet" type="text/css" href="../styles/cart_page.css">
        <?php include_once('../templates/common/simple_header.php'); ?>
        <?php include_once('../templates/common/login.tpl.php'); ?>
        <?php include_once('../templates/common/footer.php'); ?>
    </head>
    <body>
        <?php drawSimpleHeader(); ?>

        <?php drawLogin($session) ?>

        <?php drawFooter(); ?>
    </body>
</html>
