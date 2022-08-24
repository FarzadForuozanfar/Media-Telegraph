<?php 
    function Calculate($user_id)
    {
        include 'model/database.php';
        $follwers = $db->query("SELECT COUNT(*) AS cnt FROM follows WHERE following_user_id = $user_id")->fetch_assoc();
        $follwing = $db->query("SELECT COUNT(*) AS cnt FROM follows WHERE follower_user_id = $user_id")->fetch_assoc();
        $follows = array("follower"=>$follwers['cnt']-1, "following"=>$follwing['cnt']-1);
        return $follows;
    }
?>