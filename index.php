<?php
    session_start();
    date_default_timezone_set('Asia/Tehran');

    $request = $_SERVER["REQUEST_URI"];
    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
    }
    else
    {
        $id = '';
    }
    
    switch ($request) {
        case("/social_network"):
        case("/social_network/"):
        case("/social_network/index"):
        case("/social_network/index/"):
            require __DIR__."/view/index.php";
            break;

        case("/social_network/register"):
            require __DIR__."/controller/register.php";
            break;  

        case("/social_network/signup"):
            require __DIR__."/view/signup.php";
            break; 
        
        case("/social_network/login"):
        case("/social_network/signin"):
            require __DIR__."/controller/login.php";
            break;
        
        case("/social_network/home"):
            require __DIR__."/view/home.php";
            break;

        case("/social_network/newPost"):
            require __DIR__."/controller/new_post.php";
            break;
            
        case("/social_network/profile?id=".$id):
            require __DIR__."/view/profile.php";
            break;

        case("/social_network/profile"):
            require __DIR__."/view/profile.php";
            break;    
        case("/social_network/addComment"):
            require __DIR__."/controller/new_comment.php";
            break;
            
        case("/social_network/likePostProcess"):
            require __DIR__."/controller/like_proccess.php";
            break;

        case("/social_network/deletePost?id=".$id):
            require __DIR__."/controller/delete_post.php";
            break;

        case("/social_network/followProccess"):
            require __DIR__."/controller/follows_proccess.php";
            break;
        
        case("/social_network/editPost"):
            require __DIR__."/controller/editPost.php";
            break;

        case("/social_network/editprofile"):
            require __DIR__."/view/editProfile.php";
            break;

        case("/social_network/changeProfile"):
            require __DIR__."/controller/changeProfile.php";
            break;

        case("/social_network/editPersonalInfo"):
            require __DIR__."/controller/editPersonalInfo.php";
            break;
        
        case("/social_network/searchUser"):
            require __DIR__."/controller/searchUser.php";
            break;

        case("/social_network/test"):
            require __DIR__."/view/test.php";
            break;

        default:
            require __DIR__."/view/404.php";
            break;

    }
?>