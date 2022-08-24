<?php
header('Content-Type: text/html; charset=utf-8');
    if(isset($_POST))
    {
        include 'model/database.php';
        $errors = array();
        if(!empty($_POST['firstname']))
            $firstname = $_POST['firstname'];

        else
            $errors['firstname'] = "first name is required please fill field";

        if(!empty($_POST['lastname']))
            $lastname = $_POST['lastname'];

        else
            $errors['lastname'] = "last name is required please fill field";

        if(!empty($_POST['email']))
            $email = $_POST['email'];

        else
            $errors['email'] = "Email is required please fill field";

        if(!empty($_POST['username']))
        {

            $username = $_POST['username'];
            if($_SESSION['username_login']['username'] != $username)
            {
                $user_count = $db->query("SELECT * FROM `users` WHERE username = '$username'")->num_rows;
                if($user_count > 0)
                    $errors["username"] = "This Username already has been used";
                    $_SESSION['invalid_username'] = $username;

            }
        }

        else
            $errors["username"] = "Username is required please fill field";

        if ($errors == null)
        {
            $bio = $_POST['bio'];
            $id = $_SESSION['username_login']['id'];
            $db->query("UPDATE `users` SET bio = '$bio' , first_name = '$firstname' , last_name = '$lastname', email = '$email', username = '$username' WHERE id = $id");
            $name = $firstname." ". $lastname;
            $_SESSION['username_login']['name'] = $name;
            $_SESSION['username_login']['username'] = $username;
            if($db->error)
                echo  $db->error;


                header("Location: profile");
        }
        else
        {
            $_SESSION['editProfile_error'] = array();
            $_SESSION['editProfile_error']= $errors;

            header("Location:editprofile");
        }
    }
    else
    {
        header("Location:editprofile");
    }

?>