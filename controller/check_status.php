<?php
    if(isset($_SESSION['username_login']))
    {
        if($_SESSION['username_login']['login_statuse'] != true)
            header("Location:index");
    }
    else
        header("Location:index");
?>