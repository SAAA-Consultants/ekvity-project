<?php
session_start();
include("config/authentication.php");
include("config/connection.php");

// update employee
if (isset($_POST['update_employee_btn'])) {
    $employee_id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $team_id = mysqli_real_escape_string($conn, $_POST['team_id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Fetch category name based on category ID
    $category_query = "SELECT name FROM categories WHERE id = '$category_id'";
    $category_result = mysqli_query($conn, $category_query);

    if ($category_result && mysqli_num_rows($category_result) > 0) {
        $category_row = mysqli_fetch_assoc($category_result);
        $category_name = mysqli_real_escape_string($conn, $category_row['name']);

        $update_query = "UPDATE employees SET 
            name='$name', 
            designation='$designation', 
            category='$category_name',  -- Use the correct column name for category
            gender='$gender', 
            description='$description', 
            date='$date', 
            team_id='$team_id', 
            status='$status' 
        WHERE id='$employee_id'";

        if (mysqli_query($conn, $update_query)) {
            // Update successful
            $_SESSION['message'] = "Employee updated successfully";
            header("Location: employee_view.php");
            exit();
        } else {
            // Update failed
            $_SESSION['message'] = "Error updating employee: " . mysqli_error($conn);
            header("Location: employee_edit.php?id=$employee_id");
            exit();
        }
    } else {
        // Category not found
        $_SESSION['message'] = "Category not found for ID: $category_id";
        header("Location: employee_edit.php?id=$employee_id");
        exit();
    }
}
// end of update


// delete the employee
if (isset($_POST['employee_delete'])) {
    $employee_id = $_POST['employee_delete'];

    $query = "DELETE FROM employees WHERE id='$employee_id'";
    $category_run = mysqli_query($conn, $query);

    if ($category_run) {
        $_SESSION['message'] = "Employee deleted successfully";
        header("Location: employee_view.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Something went wrong..!";
        header("Location: employee_view.php");
        exit(0);
    }
}
// end of delete employee

?>