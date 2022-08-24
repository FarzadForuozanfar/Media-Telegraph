<?php
    if(!empty($_FILES['file_input']['name']) && !empty($_POST['user_id']))
    {
        include 'model/database.php';
        $id = $_POST['user_id'];
        $date = date('Y-m-d H:i:s');
        $date = str_replace(':', '-', $date);
        $img_path = "view/media/" . $date . $_FILES['file_input']['name'];
        move_uploaded_file($_FILES['file_input']['tmp_name'], $img_path);
        $db->query("UPDATE `users` SET image = '$img_path' WHERE id = $id");
        if($db->error)
            echo $db->error;
        else
        {
            $_SESSION['username_login']['profile'] = $img_path;
            header("Location:editprofile");
        }

    }
?>