<!DOCTYPE html>
<html>
    <head>
        <title>Clothes Cachet - USE or SELL</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../styles/common_style.css">
        <link rel="stylesheet" type="text/css" href="../styles/sold_items.css">
        <?php include_once('../templates/common/header.php'); ?>
        <?php include_once('../templates/profile_page/sold_items.php'); ?>
        <?php include_once('../templates/common/footer.php'); ?>
        <script src="../js/sold_items.js" defer></script>

    </head>
    <body>
        <?php drawHeader(); ?>

        <?php drawSoldItems(); ?>

        <?php drawFooter(); ?>
    </body>
</html>