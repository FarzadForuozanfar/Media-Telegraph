<?php 
    if(!empty($_POST['post_id']) && !empty($_POST['caption']))
    {
        $caption = $_POST['caption'];
        $post_id = $_POST['post_id'];

        include 'model/database.php';
        $db->query("UPDATE `posts` SET caption = '$caption' WHERE id = $post_id ");
        echo $db->error;
        header("Location: home");
    }
?>