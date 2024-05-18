<!DOCTYPE html>
<html>
    <head>
        <title>Chat</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../styles/common_style.css">
        <link rel="stylesheet" type="text/css" href="../styles/messages.css">
        <?php include_once('../templates/common/header.php'); ?>
        <?php include_once('../templates/common/footer.php'); ?>
        <?php include_once('../templates/messages/chat.tpl.php'); ?>

    </head>
    <body>
        <?php drawHeader(); ?>
        <?php chat(); ?>
        <?php drawFooter(); ?>
    </body>
</html>