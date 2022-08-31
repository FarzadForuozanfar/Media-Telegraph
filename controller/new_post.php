<?php

include 'model/database.php';
$date = date('Y-m-d H:i:s');
$date = str_replace(':', '-', $date);
$user_id = $_SESSION['username_login']['id'];
if (!empty($_POST['caption1'])) 
{
    echo "line 56"."<br>";
    $caption = $_POST['caption1'];
    if (!empty($_FILES['fileUpload']['name'])) 
    {
        $file = $_FILES['fileUpload'];
        $type = explode('/', $file['type']);
        echo "line 62"."<br>";
        if ($type[0] == 'image')
        {
            echo "line 65"."<br>";
            $file_path = "view/media/images/" . $date . $_FILES['fileUpload']['name'];
        } 

        elseif ($type[0] == 'video') 
        {
            $file_path = "view/media/videos/" . $date . $_FILES['fileUpload']['name'];
        } 

        elseif ($type[0] == 'audio') 
        {
            $file_path = "view/media/audios/" . $date . $_FILES['fileUpload']['name'];
        }

        move_uploaded_file($file['tmp_name'], $file_path);
        $db->query("INSERT INTO posts (caption, user_id, media) VALUES ('$caption', '$user_id', '$file_path')");
        if($db->error)
            echo "Error: " . $db->error;
        else
            echo "Success added post: ";
        header("Location:home");

    }
    else
    {
        echo "line 87 withuot media"."<br>";
        $db->query("INSERT INTO posts (caption, user_id) VALUES ('$caption','$user_id')");
        echo $db->error;
        header("Location:home");
    }
}
