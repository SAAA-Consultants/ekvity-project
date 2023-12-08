<?php
session_start();
include("config/authentication.php");
include("config/connection.php");

// category update

if (isset($_POST['update_category_btn'])) {
    echo "POST Data: ";
    print_r($_POST);

    // Sanitize input
    $category_id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $status = isset($_POST['status']) && $_POST['status'] ? '1' : '0';

    $category_edit = "SELECT * FROM categories WHERE id='$category_id'";
    $query_run = mysqli_query($conn, $category_edit);

    if (!$query_run) {
        die('Error in SQL query: ' . mysqli_error($conn));
    }

    $category = mysqli_fetch_assoc($query_run);

    if ($category) {
        // The rest of your code remains the same
        $query = "UPDATE categories SET 
                   name='$name', 
                   status='$status' 
                   WHERE id='$category_id'";
        
        echo "Query: $query";

        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $_SESSION['message'] = "Updated Successfully";
            echo $_SESSION['message']; // Debugging: Check if the session message is set
            header('Location: category_view.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Error updating categories information: " . mysqli_error($conn);
            echo $_SESSION['message']; // Debugging: Check if the error message is set
            header('Location: category_view.php');
            exit(0);
        }
    } else {
        echo "No Records Found";
    }
}
// end of category update


// end of category update


// end of category update



// delete th category
if(isset($_POST['category_delete']))
{
    $category_id = $_POST['category_delete'];

    $query = "DELETE FROM categories WHERE id='$category_id'";
    $category_run = mysqli_query($conn, $query);

    if($category_run)
    {
        $_SESSION['message'] = "Admin/Category Delete succesfully";
        header("Location: category_view.php");
        exit(0);

    } else
    {
        $_SESSION['message'] = "Something went wrong..!";
        header("Location: category_view.php");
        exit(0);
    }

}
// end of delete category
?>