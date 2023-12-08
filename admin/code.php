<?php
include("config/authentication.php");
include("config/connection.php");

// add user
if(isset($_POST['add_user']))
{
    $firstname = $_POST['username'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_as = $_POST['role_as'];
    $status = isset($_POST['status']) && $_POST['status'] ? '1' : '0';

    $query = "INSERT INTO users (username, lastname, email, password, role_as, status) VALUES ('$firstname', '$lastname', '$email', '$password', '$role_as', '$status')";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Admin/User Added succesfully";
        header("Location: user.php");
        exit(0);

    } else
    {
        $_SESSION['message'] = "Something went wrong..!";
        header("Location: user.php");
        exit(0);
    }
}




// End add ad user
// update usre
if(isset($_POST['update_user']))
{
    $user_id = $_POST['user_id'];
    $firstname = $_POST['username'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $role_as = $_POST['role_as'];
    $status = isset($_POST['status']) && $_POST['status'] ? '1' : '0';

    // Use single quotes around string values
    $query = "UPDATE users SET 
               username='$firstname', 
               lastname='$lastname', 
               email='$email', 
               password='$password', 
               role_as='$role_as', 
               status='$status' 
               WHERE user_id='$user_id'";

    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Updated Successfully";
        header('Location: user.php');
        exit(0);
    }
}
// end of update the user
// delete th user
if(isset($_POST['user_delete']))
{
    $user_id = $_POST['user_delete'];

    $query = "DELETE FROM users WHERE user_id='$user_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Admin/User Delete succesfully";
        header("Location: user.php");
        exit(0);

    } else
    {
        $_SESSION['message'] = "Something went wrong..!";
        header("Location: user.php");
        exit(0);
    }

}
// end of delete user
?>
