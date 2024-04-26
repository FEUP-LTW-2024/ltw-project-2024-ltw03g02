<!DOCTYPE html>
<html>
<head>
    <title>Items</title>
    <style>
        .item {
            border: 1px solid #000;
            margin: 10px;
            padding: 10px;
        }
        .item h2 {
            margin: 0;
        }
    </style>
</head>
<body>
    <?php
    require_once(dirname(__DIR__).'/../classes/item.class.php');
    require_once(dirname(__DIR__).'/../database/connection.db.php');

    if (isset($_GET['type'])) {
        $type = $_GET['type'];
        $items = Item::getItemsByType($db, $type);
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo 'Missing type parameter';
        exit;
    }

    function drawItem($item) {
        echo '<div class="item">';
        echo '<h2>' . htmlspecialchars($item['name']) . '</h2>';
        echo '<p>' . htmlspecialchars($item['description']) . '</p>';
        echo '</div>';
    }

    foreach ($items as $item) {
        drawItem($item);
    }
    ?>
</body>
</html>