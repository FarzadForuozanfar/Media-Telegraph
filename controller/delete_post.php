<?php
    if($_SESSION['username_login']['login_statuse'])
    {
        include "model/database.php";
        $post_id =  $_GET['id'];
        $post = $db->query("SELECT * FROM `posts` WHERE id = $post_id")->fetch_assoc();
        if($_SESSION['username_login']['id'] == $post['user_id'])
        {
            $db->query("DELETE FROM `posts` WHERE id = $post_id");
            $db->query("DELETE FROM `likes` WHERE post_id = $post_id");
            $db->query("DELETE FROM `comments` WHERE  post_id = $post_id");
            unlink($post['media']);
        }

    }
    header("Location:home");

?>
