<?php 
    if(!empty($_FILES['fileUpload']))
    {
        
        $type = explode('/',$_FILES['fileUpload']['type']);
        if($type[0] == 'image')
        {
            include 'model/database.php';
            $time = date('h:i:s');
            $time = str_replace(':', '-', $time);
            $path = "view/stories/" .$time."_".$_FILES['fileUpload']['name'];
            $user_id = $_SESSION['username_login']['id'];
            $last_story = $db->query("SELECT * FROM story WHERE user_id = $user_id")->fetch_assoc();
            if(isset($last_story['user_id']))
            {
                unlink($last_story['media']);
                $db->query("DELETE FROM story WHERE user_id = $user_id");
                $db->query("INSERT INTO story (user_id, media) VALUES($user_id, '$path')");
            }
            else
            {
                $db->query("INSERT INTO story (user_id, media) VALUES($user_id, '$path')");
            }
            move_uploaded_file($_FILES['fileUpload']['tmp_name'], $path);

        }
        if($_SESSION['username_login']['location'] == "home")
            {
                header("Location:home");
            }
        else
            header("Location:profile");
    }
?>