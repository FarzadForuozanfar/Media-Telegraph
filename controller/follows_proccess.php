<?php
    include 'model/database.php';
    $follwer_id = $_POST['follower_id'];
    $follwing_id = $_POST['following_id'];

    if($db->query("SELECT * FROM follows WHERE follower_user_id = $follwer_id AND following_user_id = $follwing_id")->num_rows > 0)
    {
        $db->query("DELETE FROM follows WHERE follower_user_id = $follwer_id AND following_user_id = $follwing_id");
    }
    else
    {
        $db->query("INSERT INTO follows (follower_user_id, following_user_id) VALUES($follwer_id, $follwing_id)");
    }
?>