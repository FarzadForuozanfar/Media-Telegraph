<?php
    if(!empty($_POST['caption2']))
    {
        include 'model/database.php';
        $user_id = $_SESSION['username_login']['id'];  
        $caption = $_POST['caption2'];
        
        $db->query("INSERT INTO posts (caption, user_id) VALUES ('$caption','$user_id')");
        echo $db->error;
        header("Location:home");
    }
    else if(!empty($_POST['caption1']))
    {

    }
?>