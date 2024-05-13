<?php
    session_start();
    if (session_unset()){
        
        header('Location: ../pages/home_page.php');
    } else {
        echo "Error: " . $e->getMessage();
    }
?>