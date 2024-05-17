<!DOCTYPE html>
<html>
    <head>
        <title>Messages</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../styles/common_style.css">
        <link rel="stylesheet" type="text/css" href="../styles/messages.css">
        <?php include_once('../templates/common/header.php'); ?>
        <?php include_once('../templates/common/footer.php'); ?>
        <?php include_once('../templates/messages/message.php'); ?>

    </head>
    <body>
        <?php drawHeader(); ?>
        <?php messages(); ?>
        <?php drawFooter(); ?>
    </body>
</html>