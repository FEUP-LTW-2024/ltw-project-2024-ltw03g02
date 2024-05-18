<?php
    declare(strict_types = 1);
    session_start();
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['index'])) {
        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        $index = $data['index'];
        if (isset($_SESSION['cart'][$index])) {
            unset($_SESSION['cart'][$index]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            echo "Item at index " . $index . " removed from cart!";
        } else {
            echo "Invalid index provided.";
        }
        foreach ($_SESSION['cart'] as $item) {
            echo "\n" . $item;
        }
    } else {
        echo "No index provided.";
    }
?>