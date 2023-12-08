<?php
session_start();
include('config/connection.php');


// Check if the form is submitted
if (isset($_POST['register_btn'])) {
    // Get form data
    $firstName = mysqli_real_escape_string($conn, $_POST['username']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn,$_POST['cpassword']);
  
    if ($password == $confirm_password) {
        $checkemail = "SELECT email FROM users WHERE email ='$email'";
        $checkemail_run = mysqli_query($conn, $checkemail);
    
        if (mysqli_num_rows($checkemail_run) > 0) {
            $_SESSION["message"] = "Email already exists";
            header("Location:register.php");
            exit(0);
        }
     else 
      {
        $user_query = "INSERT INTO users (username, lastname, email, password) VALUES ('$firstName', '$lastName', '$email', '$password')";
        $user_query_run = mysqli_query($conn, $user_query);

        if($user_query_run)
        {
            $_SESSION["message"] = "Register succesfully";
            header("Location:login.php");
            exit(0);

        }
        else{
            $_SESSION['message'] ="Something went wrong!";
            header("Location:register.php");
            exit(0);
        }

      }
    }

else
{
    $_SESSION["message"] = "Password and confirm password does not match";
    header("Location:register.php");
    exit(0);
}
}else{
    header("Location:register.php");
    exit(0);
}

?>