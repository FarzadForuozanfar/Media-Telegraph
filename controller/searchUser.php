<?php
    if(isset($_POST))
    {
        if(!empty($_POST['search-input']))
        {
            $res=[];
            $follower_id = $_SESSION['username_login']['id'];
            $username = $_POST['search-input'];
            include 'model/database.php';
            $result = $db->query("SELECT id, username, image FROM `users` WHERE `username` LIKE '%$username%'");
            if($result->num_rows > 0){
                while ( $record = $result->fetch_assoc() ) {
                    $following_id = $record['id'];
                    $follow = $db->query("SELECT * FROM `follows` WHERE follower_user_id = $follower_id AND following_user_id = $following_id")->num_rows;
                    $record['follows'] = $follow;
                    $record['my_id'] = $follower_id;
                    if($follower_id == $following_id)
                    {
                        $record['me'] = true;
                    }
                    else
                    {
                        $record['me'] = false;
                    }
                    $res[]=$record;  
                }
                echo json_encode($res, true);
            }
            else
                {
                    $res[] = '{"image":null,"username":"not found","id":null}';
                    echo json_encode($res, true);
                }
        }
        else
            {
                $res[] = '{"image":null,"username":"not found","id":null}';
                echo json_encode($res, true);
            }
            
    }
    else
    echo "no words to search";
?>