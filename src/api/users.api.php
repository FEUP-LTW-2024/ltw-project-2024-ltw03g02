<?php
    declare(strict_types = 1);
    require_once(dirname(__DIR__).'/database/connection.db.php');
    require_once(dirname(__DIR__).'/classes/user.class.php');
    require_once(dirname(__DIR__).'/classes/session.class.php');
    $session = new Session();

    $db = getDatabaseConnection();
    $users = User::getAllUsers($db);

    $currentUserId = $_SESSION['idUser'];
    

    $usernamesAndProfilePictures = [];
    foreach ($users as $user) {
        $idUser = $user->getUserId();
        $username = $user->getUsername();
        $profilePicture = $user->getProfileImageLink();
        $usernamesAndProfilePictures[] = [
            'idUser' => $idUser,
            'username' => $username,
            'profile_image_link' => $profilePicture
        ];
    }

    include dirname(__DIR__).'/templates/users_show.tpl.php';

    drawUsers($usernamesAndProfilePictures);
?>