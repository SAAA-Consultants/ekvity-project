<?php
session_start();
include("config/authentication.php");
include("config/connection.php");

// delete th user
if(isset($_POST['job_delete']))
{
    $user_id = $_POST['job_delete'];

    $query = "DELETE FROM job_requirements WHERE id='$user_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Admin/job Delete succesfully";
        header("Location: job_view.php");
        exit(0);

    } else
    {
        $_SESSION['message'] = "Something went wrong..!";
        header("Location: job_view.php");
        exit(0);
    }

}
?>
