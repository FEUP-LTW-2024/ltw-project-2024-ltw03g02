<?php
    declare(strict_types = 1);
    session_start();
    if (isset($_POST['idItem'])) {
        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        $_SESSION['cart'][] = $_POST['idItem'];
        echo "Item " . $_POST['idItem'] . " added to cart!";
        foreach ($_SESSION['cart'] as $item) {
            echo "\n" . $item;
        }
    } else {
        echo "No item ID provided.";
    }
?>