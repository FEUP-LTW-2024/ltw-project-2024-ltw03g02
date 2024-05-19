<!DOCTYPE html>
<html>
    <head>
        <title>Chat</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../styles/common_style.css">
        <link rel="stylesheet" type="text/css" href="../styles/about_us.css">
        <?php include_once('../templates/common/header.php'); ?>
        <?php include_once('../templates/common/footer.php'); ?>
        <?php include_once('../templates/static/about_us.tpl.php'); ?>

    </head>
    <body>
        <?php drawHeader(); ?>
        <?php aboutUs(); ?>
        <?php drawFooter(); ?>
    </body>
</html>