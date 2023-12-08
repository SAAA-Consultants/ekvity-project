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

    // Check if a new image is provided
    if ($_FILES['image']['error'] == 0) {
        $image = mysqli_real_escape_string($conn, $_FILES['image']['name']);
        $target_dir = "teamimage/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    } else {
        // No new image provided, fetch the existing image value
        $existing_image_query = "SELECT image FROM employees WHERE id = '$employee_id'";
        $existing_image_result = mysqli_query($conn, $existing_image_query);

        if ($existing_image_result && mysqli_num_rows($existing_image_result) > 0) {
            $existing_image_row = mysqli_fetch_assoc($existing_image_result);
            $image = mysqli_real_escape_string($conn, $existing_image_row['image']);
        } else {
            // Handle the case where the existing image cannot be fetched
            $_SESSION['message'] = "Error fetching existing image for employee ID: $employee_id";
            header("Location: employee_edit.php?id=$employee_id");
            exit();
        }
    }

    // Fetch category name based on category ID
    $category_query = "SELECT name FROM categories WHERE id = '$category_id'";
    $category_result = mysqli_query($conn, $category_query);

    if ($category_result && mysqli_num_rows($category_result) > 0) {
        $category_row = mysqli_fetch_assoc($category_result);
        $category_name = mysqli_real_escape_string($conn, $category_row['name']);

        $update_query = "UPDATE employees SET 
            name='$name', 
            designation='$designation', 
            category='$category_name', 
            gender='$gender', 
            description='$description', 
            image='$image', 
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
    $employee_id = mysqli_real_escape_string($conn, $_POST['employee_delete']);

    // Retrieve the image filename before deleting the employee
    $image_query = "SELECT image FROM employees WHERE id='$employee_id'";
    $image_result = mysqli_query($conn, $image_query);

    if ($image_result && mysqli_num_rows($image_result) > 0) {
        $image_row = mysqli_fetch_assoc($image_result);
        $image_filename = $image_row['image'];

        // Delete the employee
        $delete_query = "DELETE FROM employees WHERE id='$employee_id'";
        $delete_result = mysqli_query($conn, $delete_query);

        if ($delete_result) {
            // Delete the image file from the folder
            $image_path = "teamimage/" . $image_filename;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $_SESSION['message'] = "Employee deleted successfully";
            header("Location: employee_view.php");
            exit();
        } else {
            $_SESSION['message'] = "Error deleting employee";
            header("Location: employee_view.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Error retrieving image information";
        header("Location: employee_view.php");
        exit();
    }
}
// end of delete employee

?>