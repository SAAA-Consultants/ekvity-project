<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_multiple_data'])) {
    // Establish a new database connection
    $connection = mysqli_connect("localhost", "root", "", "blog_ekvity");

    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get values from the form
    $job_id = $_POST['job_id'];
    $category = $_POST['category'];
    $job_title = $_POST['job_title'];
    $location = $_POST['location'];
    $employment_type = $_POST['employment_type'];
    $date = $_POST['date'];
    $notice_period = isset($_POST['notice_period']) ? $_POST['notice_period'] : '';
    $status = isset($_POST['status']) ? 1 : 0;

   // Update job details
   foreach ($_POST['job_description'] as $key => $job_description) {
    $subtitle_value = $_POST['job_description'][$key];
    $qualifications = $_POST['qualifications'][$key];
    $skills = $_POST['skills'][$key];
    $detail_id = $_POST['detail_id'][$key];
    // Check if detail_id is set for the current key
    if (isset($_POST['detail_id'][$key])) {
        $detail_id = $_POST['detail_id'][$key];
        $subtitle_value = $_POST['job_description'][$key];
        $qualifications = $_POST['qualifications'][$key]; // Corrected variable name
        $skills = $_POST['skills'][$key];

        // Prepare the update query for job_details
        $update_details_query = "UPDATE job_details SET job_description=?, qualifications=?, skills=? WHERE id=?";
        $stmt_details = mysqli_prepare($connection, $update_details_query);

        // Check if the prepared statement is created successfully
        if ($stmt_details) {
            // Bind parameters and execute the statement
            mysqli_stmt_bind_param($stmt_details, "sssi", $subtitle_value, $qualifications, $skills, $detail_id);
            $update_details_result = mysqli_stmt_execute($stmt_details);
            mysqli_stmt_close($stmt_details);

            // Check the result of the execution
            if (!$update_details_result) {
                $_SESSION['message'] = "Error updating job details: " . mysqli_error($connection);
                header("Location: job_view.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "Error preparing statement for job details: " . mysqli_error($connection);
            header("Location: job_view.php");
            exit();
        }
    }
}

    // Update the job entry in the database
    $update_query = "UPDATE job_requirements SET 
        category = '$category', 
        job_title = '$job_title', 
        location = '$location', 
        employment_type = '$employment_type', 
        date = '$date', 
        notice_period = '$notice_period', 
        status = '$status' 
        WHERE id = $job_id";

    // Execute the main update query
    $update_result = mysqli_query($connection, $update_query);

    // Check if the main update query is successful
    if ($update_result) {
        $_SESSION['message'] = "Record updated successfully";
    } else {
        $_SESSION['message'] = "Error updating record: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);

    // Redirect to job_view.php
    header("Location: job_view.php");
    exit(); // Make sure to exit after a header redirect
} else {
    echo "Invalid request!";
    // Redirect to job_view.php
    header("Location: job_view.php");
    exit(); // Make sure to exit after a header redirect
}
?>
