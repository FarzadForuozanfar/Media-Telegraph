<?php
    $db = new mysqli("localhost","root"," ","social_media");
    
    if($db->connect_error)
    {
        echo $db->connect_error;
    }
    else
    {
        $db->query("SET CHARACTER SET utf8mb4");
    }
?>
