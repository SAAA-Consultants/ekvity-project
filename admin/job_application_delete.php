<?php
session_start();
include('config/connection.php');

// delete the category
if (isset($_POST['job_application_delete'])) {
    $category_id = $_POST['job_application_delete'];

    $query = "DELETE FROM job_applications WHERE id='$category_id'";
    $category_run = mysqli_query($conn, $query);

    if ($category_run) {
        $_SESSION['message'] = "Admin/job_applications Delete successfully";
        header("Location: job_application.php");
exit();

    } else {
        $_SESSION['message'] = "Something went wrong..!";
        header("Location: job_application.php");
exit();

    }
}

// Debugging: Check if resumePath is retrieved correctly
echo "Resume Path: $resumePath<br>";

// Perform the delete operation
$deleteQuery = "DELETE FROM job_applications WHERE id = ?";
$stmt = mysqli_prepare($connection, $deleteQuery);
mysqli_stmt_bind_param($stmt, "i", $deleteId);
$result = mysqli_stmt_execute($stmt);

// Debugging: Check if the delete operation is successful
echo "Delete Result: $result<br>";

if ($result) {
    // Delete the associated resume file
    if (file_exists($resumePath)) {
        unlink($resumePath);
        echo "Resume File Deleted<br>";
    }

    $_SESSION['status'] = "Record and associated resume deleted successfully!";
} else {
    $_SESSION['status'] = "Error deleting record: " . mysqli_error($connection);
}

// Close the prepared statement and the database connection
mysqli_stmt_close($stmt);
mysqli_close($connection);

// Redirect back to the page where the delete button was clicked
header("Location: job_application.php");
exit();

?>
