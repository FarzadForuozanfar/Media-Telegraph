<?php
    include "model/database.php";
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];
    if($db->query("SELECT * FROM likes where user_id = $user_id AND post_id = $post_id")->num_rows > 0)
    {
        $db->query("DELETE FROM likes WHERE post_id = $post_id AND user_id = $user_id");
    }
    else
    {
        $db->query("INSERT INTO likes (post_id, user_id) VALUES ($post_id, $user_id)");
    }
?>