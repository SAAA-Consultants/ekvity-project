<?php
session_start();

// Check if the form is submitted
if (isset($_POST['save_multiple_data'])) {
     // Connect to the database (update with your database credentials)
     $connection = mysqli_connect("localhost", "root", "", "blog_ekvity");

     // Check connection
     if (!$connection) {
         die("Connection failed: " . mysqli_connect_error());
     }

    $pdf_upload = ""; // Initialize the variable

    // Check if a file is uploaded successfully
    if (isset($_FILES['pdf_upload']) && $_FILES['pdf_upload']['error'] == 0) {
        $target_dir = "pdfuploads/"; // Specify the directory where you want to save the uploaded file
        $target_file = $target_dir . basename($_FILES['pdf_upload']['name']);
        $file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check file extension
        $allowed_extensions = array("pdf");
        if (in_array($file_extension, $allowed_extensions)) {
            // Move the uploaded file to the desired directory
if (move_uploaded_file($_FILES['pdf_upload']['tmp_name'], $target_file)) {
    // File uploaded successfully, now store the file path in the database
    $pdf_upload = basename($target_file); // Extract the actual file name
} else {
    // Error uploading file
    $_SESSION['status'] = "Error uploading file.";
    header("Location: job_view.php");
    exit();
}

        } else {
            // Invalid file type
            $_SESSION['status'] = "Invalid file type. Please upload a PDF file.";
            header("Location: job_view.php");
            exit();
        }
    } else {
        // No file uploaded
        $_SESSION['status'] = "No file uploaded.";
        header("Location: job_view.php");
        exit();
    }
    // Get form data
    $category = $_POST['category'];
    $job_title = $_POST['job_title'];
    $location = $_POST['location'];
    $employment_type = $_POST['employment_type'];
    $job_description = $_POST['job_description'];
    $qualifications = $_POST['qualifications'];
    $skills = $_POST['skills'];
    $notice_period = $_POST['notice_period'];
    $date = $_POST['date'];
    $status = isset($_POST['status']) ? 1 : 0; // Checkbox status

    // Validate and sanitize the data as needed

   

    // Insert data into the job_requirements table
    $query = "INSERT INTO job_requirements (category, job_title, location, employment_type, job_description, qualifications, skills, notice_period, date, status, pdf_upload) VALUES ('$category', '$job_title', '$location', '$employment_type', '$job_description', '$qualifications', '$skills', '$notice_period', '$date', '$status', '$pdf_upload')";
    $result = mysqli_query($connection, $query);

    
    
    // Continue with the rest of your code...
    

    // Check if the data is inserted successfully
    if ($result) {
        // Get the last inserted job ID
        $job_id = mysqli_insert_id($connection);

        // Insert dynamic fields (job_description, qualifications, skills)
        foreach ($_POST['job_description'] as $key => $description) {
            $qualification = $_POST['qualifications'][$key];
            $skill = $_POST['skills'][$key];

            $query = "INSERT INTO job_details (job_id, job_description, qualifications, skills) 
                      VALUES ('$job_id', '$description', '$qualification', '$skill')";
            mysqli_query($connection, $query);
        }

        $_SESSION['status'] = "Job added successfully!";
    } else {
        $_SESSION['status'] = "Error: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);

    // Redirect to the page where the form is displayed
    header("Location: job_view.php");
    exit();
} else {
    // Redirect to the form page if the form is not submitted
    header("Location: job_view.php");
    exit();
}
?>
