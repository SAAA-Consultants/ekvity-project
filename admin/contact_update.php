<?php
session_start();
include("config/authentication.php");
include("config/connection.php");
// delete th contact
if(isset($_POST['contact_delete']))
{
    $category_id = $_POST['contact_delete'];

    $query = "DELETE FROM contact_messages WHERE id='$category_id'";
    $category_run = mysqli_query($conn, $query);

    if($category_run)
    {
        $_SESSION['message'] = "Admin/contact Delete succesfully";
        header("Location:contact.php");
        exit(0);

    } else
    {
        $_SESSION['message'] = "Something went wrong..!";
        header("Location:contact.php");
        exit(0);
    }

}
// end of delete contact
?>