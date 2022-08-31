<?php
    if(!empty($_POST['id_user']))
    {
        $user_id = $_POST['id_user'];
        if($_SESSION['username_login']['id'] == $user_id)
        {
            include 'model/database.php';
            $last_story = $db->query("SELECT * FROM story WHERE user_id = $user_id")->fetch_assoc();
            unlink($last_story['media']);
            $db->query("DELETE FROM story WHERE user_id = $user_id");
        }
        header("Location:home");
    }
?>
