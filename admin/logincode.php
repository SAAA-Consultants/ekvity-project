<?php
session_start();
include('config/connection.php');

if(isset($_POST['login_btn'])) 
{
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
    $login_query_run = mysqli_query($conn,$login_query);

if(mysqli_num_rows($login_query_run) > 0)
{
    foreach($login_query_run as $data){
        $user_id = $data['id'];
        $user_name = $data['username']. '' .$data['lastname'];
        $user_email = $data['email'];
        $role_as = $data['role_as'];
    }
        $_SESSION['auth'] = true;
        $_SESSION['auth_role'] = "$role_as";//1=admin , 0=user
        $_SESSION['auth_user'] =[
        'user_id'=> $user_id,
        'user_name'=> $user_name,
        'user_email'=> $user_email,
                                ];
         if($_SESSION['auth_role'] == '1')//1==admin     
         {
            $_SESSION['message'] ='Welcome to dashboard';
            header("location: index.php");
            exit(0);

         }elseif($_SESSION['auth_role'] == '0')//0-user
         {
            $_SESSION['message'] ='You are logged in';
            header("location: blog.php");
            exit(0);
         }                  

}else{
    $_SESSION['message'] ='Invalid Email or Password';
    header("location: login.php");
    exit(0);
}

}else{
    $_SESSION['message'] ='You are not allowed to access to this file';
    header("location: login.php");
    exit(0);

}





?>