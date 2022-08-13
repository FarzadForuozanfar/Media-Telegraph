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
            $gender = 1;
        elseif($gender_tmp == "female")
            $gender = 0;
        else
            $gender = 2;

        if($password1 == $password2)
        {
            $password = md5($password1);
            $user_count = $db->query("SELECT * FROM users WHERE username = '$username'")->num_rows; 
            
            if($user_count == 0) //unice username
            {
                $db->query("INSERT INTO `users`(first_name , last_name, email, phone, password, username, gender, birthday) VALUES ('$firstname','$lastname','$email','$phone','$password','$username',$gender,'$birthdate')");
                echo $db->error;
                
                //header("Location:home");

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
    if($errors == null)
    {
        header("Location: index");
    }
    else
    {
        $_SESSION['errors'] = $errors;
        header("Location: signup");
    }
    
?>