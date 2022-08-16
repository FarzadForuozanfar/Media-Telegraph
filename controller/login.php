<?php
if(!empty($_POST))
{
    include 'model/database.php';
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username && $password)
    {
        $user_table = $db->query("SELECT * FROM users WHERE username = '$username'");
        if($user_table->num_rows == 1)
        {
            $user = $user_table->fetch_assoc();
            $security_password = md5($password);
            if($security_password == $user['password'])
            {
                $name = $user['name']." ". $user['last_name'];
                $statuse = array("username"=>$user['username'], "login_statuse"=>true, "id"=>$user['id'], "name"=>$name, "profile"=>$user['image'], "gender"=>$user['gender']);
                $_SESSION['username_login'] = $statuse;
                header("Location:home");
            }

            else
            {
                $_SESSION['error'] = 'Invalid password';
                header("Location: index");
            }
        }
        else
        {
            $_SESSION['error'] = 'Invalid username';
            header("Location: index");
        }
    }
}
else
    header("Location: index");
?>
