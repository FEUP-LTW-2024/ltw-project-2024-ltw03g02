<?php
    session_start();
    if (session_unset()){
        session_destroy();
        header('Location: ../pages/home_page.php');
    } else {
        echo "Error: " . $e->getMessage();
    }
?>