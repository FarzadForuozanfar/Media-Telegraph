<?php 
    function GetLikes($post_id,$user_id)
    {
        include 'model/database.php';
        $users_liked = $db->query("SELECT *, users.id AS id_user FROM likes INNER JOIN users ON users.id = likes.user_id WHERE likes.post_id = $post_id");
        foreach($users_liked as $user)
        {
                $image = $user['image'];
                $username = $user['username'];
                $id = $user['id_user'];
                if($user_id != $id)
                {
                    if($db->query("SELECT * FROM `follows` WHERE follower_user_id = $user_id AND following_user_id = $id")->num_rows > 0)
                    {
                        $button = "<button onclick='FollowsProccess(this,$id)' type='button' class='text-yellow-400 btn btn-outline-warning hover:bg-yellow hover:text-gray-900 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5'>Unfollow</button>";
                    }
                    else
                    {
                        $button = "<button onclick='FollowsProccess(this,$id)' type='button' class='text-gray-900 bg-yellow hover:bg-yellow hover:text-gray-900 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5'>
                                        Follow
                                    </button>";
                    }
                }
                else
                    $button = '';
                echo 
                    "<div class='col-12 d-flex hover:bg-gray-800 align-items-center'>
                        <div class='col-7 text-gray-50'>
                                <a href='profile?id=$id' class='flex items-center py-2 px-1'>
                                <img class='mr-2 w-9 h-9 border border-3 p-0 border-warning rounded-full' src='$image' alt='$username'>
                                $username
                                </a>
                        </div>
                        <div class ='col-5 d-flex justify-content-end px-1'>
                            <form id='form-follows-$id'>
                                $button
                                <input type='hidden' name='following_id' value='$id'>
                                <input type='hidden' name='follower_id' value='$user_id'>
                            </form>
                        </div>
                    </div>";
        }
    }
