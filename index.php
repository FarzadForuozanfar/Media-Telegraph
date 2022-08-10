<?php

    $request = $_SERVER["REQUEST_URI"];
    switch ($request) {
        case("/social_network"):
        case("/social_network/"):
        case("/social_network/index.php"):
        case("/social_network/index.php/"):
        case("/social_network/signup.php"):
        case("/social_network/login.php"):
            require __DIR__."/view/index.php";
            //echo __DIR__."/view/index.php";
            break;
        default:
            require __DIR__."/view/404.php";
            break;

    }
?>