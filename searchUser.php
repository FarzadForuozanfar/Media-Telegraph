<?php
    if(isset($_POST))
    {
        if(!empty($_POST['search-input']))
        {
            $res=[];
            $username = $_POST['search-input'];
            include 'model/database.php';
            $result = $db->query("SELECT id, username, image FROM `users` WHERE `username` LIKE '%$username%'");
            if($result->num_rows > 0){
                while ( $record = $result->fetch_assoc() ) {
                    
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