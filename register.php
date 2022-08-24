<?php 
    include 'model/database.php';
    $errors = array(); 
    if($_POST['firstname'] != null && $_POST['lastname'] != null && $_POST['email'] !=null && $_POST['phone'] != null && $_POST['password'] != null && $_POST['confirmpassword'] != null && $_POST['username'] != null)
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password1 = $_POST['password'];
        $password2 = $_POST['confirmpassword'];
        $username = $_POST['username'];
        $gender_tmp = $_POST['gender'];
        $birthdate = $_POST['birthdate'];

        if($gender_tmp == "male")
            {
                $gender = 1;
                $img = "view/img/male.png";
            }
        elseif($gender_tmp == "female")
           {
                $gender = 0;
                $img = "view/img/female.png";
           }
        else
            {
                $gender = 2;
                $img = "view/img/user.png";
            }

        if($password1 == $password2)
        {
            $password = md5($password1);
            $user_count = $db->query("SELECT * FROM users WHERE username = '$username'")->num_rows; 
            
            if($user_count == 0) //unice username
            {

                $img_id = rand(0,60);
                $cover = "https://picsum.photos/id/$img_id/1200/600";
                $db->query("INSERT INTO `users`(first_name , last_name, email, phone, password, username, gender, birthday, cover, image) VALUES ('$firstname','$lastname','$email','$phone','$password','$username',$gender,'$birthdate','$cover','$img')");
                echo $db->error;
                $user = $db->query("SELECT id FROM `users` WHERE first_name = '$firstname' AND last_name = '$lastname' AND username = '$username'")->fetch_assoc();
                $user_id = $user['id'];
                $db->query(("INSERT INTO follows(follower_user_id, following_user_id) VALUES ($user_id, $user_id)"));

            }
            else
            {
                $errors [] = "This username has already been used";
            }
                
        }

        else
        {
            $errors []="The passwords not match";
        }
        
    }
    else
    {
        $errors[]="Complete necessary information";
    }
    if($errors != null)
    {
        $_SESSION['errors'] = $errors;
        header("Location: signup");
    }
    else
    {
        header("Location:index");
    }
    
?>