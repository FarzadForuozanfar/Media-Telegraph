<?php 
    if(!empty($_POST['post_id']) && !empty($_POST['caption']))
    {
        $caption = $_POST['caption'];
        $post_id = $_POST['post_id'];
        $location = $_POST['location'];
        include 'model/database.php';
        $db->query("UPDATE `posts` SET caption = '$caption' WHERE id = $post_id ");
        echo $db->error;
        if($location == 'home')
        {
            header("Location: home");
        }
        elseif($location == 'profile')
        {
            header("Location: profile");
        }
    }
?>

