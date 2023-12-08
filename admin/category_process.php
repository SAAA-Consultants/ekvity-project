<?php
session_start();
include("config/authentication.php");
include("config/connection.php");
// add user
if(isset($_POST['category_btn']))
{
    // Validate and sanitize input
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $status = isset($_POST['status']) ? 1 : 0;

    // Use prepared statement to prevent SQL injection
    $query = "INSERT INTO categories (name, status) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "si", $name, $status);
        $category_run = mysqli_stmt_execute($stmt);

        if($category_run)
        {
            $_SESSION['message'] = "Admin/Categories Added successfully";
            header("Location: category_view.php");
            exit(0);
        } else
        {
            $_SESSION['message'] = "Error: " . mysqli_error($conn);
            header("Location: category_view.php");
            exit(0);
        }

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['message'] = "Error: " . mysqli_error($conn);
        header("Location: category_view.php");
        exit(0);
    }
}


// End add ad user




?>