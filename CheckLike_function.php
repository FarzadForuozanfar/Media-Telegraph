<?php
    
    function CheckLike($user_id,$post_id)
    {
        include 'model/database.php';
        if($db->query("SELECT * FROM likes WHERE user_id = $user_id AND post_id = $post_id")->num_rows > 0)
        {
            return "bi-heart-fill text-danger";
        }
        else
        {
            return "bi-heart text-white";
        }
    }
?>