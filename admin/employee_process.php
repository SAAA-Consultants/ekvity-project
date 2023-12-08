<?php
session_start();
include('config/authentication.php');
include('config/connection.php');

// Check if the form is submitted
if (isset($_POST['add_employee_btn'])) {
    // Retrieve form data
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $image = mysqli_real_escape_string($conn, $_FILES['image']['name']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $team_id = mysqli_real_escape_string($conn, $_POST['team_id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
// Fetch category name based on category ID
$category_query = "SELECT name FROM categories WHERE id = '$category_id'";
$category_result = mysqli_query($conn, $category_query);

if ($category_result && mysqli_num_rows($category_result) > 0) {
    $category_row = mysqli_fetch_assoc($category_result);
    $category_name = mysqli_real_escape_string($conn, $category_row['name']);

    // Upload image file
    $target_dir = "teamimage/";
    $target_file = $target_dir . basename($_FILES['image']['name']);

    // Check if file was successfully uploaded
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {

        // Insert data into the database
        $query = "INSERT INTO employees (name, designation, category, gender, description, image, date, team_id, status)
                  VALUES ('$name', '$designation', '$category_name', '$gender', '$description', '$image', '$date', '$team_id', '$status')";

        if (mysqli_query($conn, $query)) {
            $_SESSION['message'] = "Employee added successfully";
            header("Location: carrier.php");
            exit();
        } else {
            $_SESSION['message'] = "Error: " . mysqli_error($conn);
            header("Location: carrier.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Error uploading image";
        header("Location: carrier.php");
        exit();
    }
} else {
    header("Location: carrier.php");
    exit();
}

// Close the database connection
mysqli_close($conn);
}
?>
