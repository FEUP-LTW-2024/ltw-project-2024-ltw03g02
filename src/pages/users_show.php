<!DOCTYPE html>
<html>
    <head>
        <title>Messages</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../styles/common_style.css">
        <link rel="stylesheet" type="text/css" href="../styles/users_show.css">
        <?php include_once('../templates/common/header.php'); ?>
        <?php include_once('../templates/common/footer.php'); ?>
    </head>
    <body>
        <?php drawHeader(); ?>
        <?php include_once('../api/users.api.php'); ?>
        <?php include_once('../templates/show/users_show.tpl.php'); ?>
        <?php drawFooter(); ?>
    </body>
</html>