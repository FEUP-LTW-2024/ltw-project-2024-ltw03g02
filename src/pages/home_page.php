<!DOCTYPE html>
<html>
    <head>
        <title>Clothes Cachet - USE or SELL</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../styles/common_style.css">
        <link rel="stylesheet" type="text/css" href="../styles/home_page.css">
        <?php include_once('../templates/common/header.php'); ?>
        <?php include_once('../templates/common/footer.php'); ?>
        <?php include_once('../templates/home_page/hero.php'); ?>
        <?php include_once('../templates/home_page/clothes_type.php'); ?>
        <?php include_once('../templates/home_page/brands.php'); ?>
        <?php include_once('../templates/home_page/drawer.php'); ?>

        <?php include_once('../templates/common/item_card.php'); ?>

    </head>
    <body>
        <?php drawHeader(); ?>

        <?php drawHero(); ?>
        <?php drawClothesType(); ?>
        <?php drawBrands(); ?>

        <?php drawItemCard(); ?>

        <?php drawFooter(); ?>
    </body>
</html>