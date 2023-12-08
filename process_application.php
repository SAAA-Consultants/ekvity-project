<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoload file
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Start output buffering
ob_start();

if (isset($_POST['submit_application'])) {
    // Get form data
    $jobId = $_POST['job_id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $location = $_POST['location'];

    /// File upload handling
    $resumePath = '';
    if (isset($_FILES['resume_path']) && $_FILES['resume_path']['error'] === UPLOAD_ERR_OK) {
        $resumeName = basename($_FILES['resume_path']['name']);
        $resumePath = '' . $resumeName; // Use a relative path

        // Debugging: Check if the directory exists
        $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . '/ekvity-admin-panel/admin/resume/';
        if (!file_exists($uploadDirectory)) {
            echo "Directory does not exist.";
            mkdir($uploadDirectory, 0755, true); // Create the directory
        }

        // Debugging: Check directory permissions
        if (!is_writable($uploadDirectory)) {
            echo "Directory is not writable.";
            exit(); // Stop execution if the directory is not writable
        }

        // Debugging: Check file upload status
        if (move_uploaded_file($_FILES['resume_path']['tmp_name'], $uploadDirectory . $resumeName)) {
            echo "File uploaded successfully.";
        } else {
            echo "Error uploading file. Destination: $resumePath";
            exit(); // Stop execution if there's an issue with file upload
        }
    }

    // Create a PHPMailer object
    $mail = new PHPMailer;

    // Enable verbose debug output
    $mail->SMTPDebug = 2;

    // Set mailer to use SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Replace with your SMTP host
    $mail->SMTPAuth = true;
    $mail->Username = 'pradnyafarkande65@gmail.com';  // Replace with your SMTP username
    $mail->Password = 'dhdj lrvo rpjn ogig';  // Replace with your SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Choose TLS or SSL
    $mail->Port = 587;  // Choose the appropriate port

    // Set email parameters
    $mail->setFrom('pradnyafarkande65@gmail.com', 'Your Name');  // Replace with your sender's email address and name
    $mail->addAddress('pradnyafarkande65@gmail.com', 'Recipient Name');  // Replace with your recipient's email address and name
    $mail->Subject = 'New Job Application Submission';
    $mail->Body = "Job ID: $jobId\nFirst Name: $firstName\nLast Name: $lastName\nEmail: $email\nContact: $contact\nLocation: $location";

    // Attach resume if it's uploaded
    if (!empty($resumePath)) {
        $mail->addAttachment($uploadDirectory . $resumeName, $resumeName);
    }

    /// Send the email
    if ($mail->send()) {
        // Email sent successfully
        $_SESSION['status'] = "Application submitted successfully!";
    } else {
        // Handle mail sending error
        $_SESSION['status'] = "Error sending email: " . $mail->ErrorInfo;
        echo $_SESSION['status']; // Output the error to the page for debugging
    }

    // Connect to the database
    $connection = mysqli_connect("localhost", "root", "", "blog_ekvity");

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert data into the database using prepared statements
    $query = "INSERT INTO job_applications (job_id, first_name, last_name, email, contact, location, resume_path) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "isssiss", $jobId, $firstName, $lastName, $email, $contact, $location, $resumePath);

    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        $_SESSION['status'] = "Application submitted successfully!";
    } else {
        $_SESSION['status'] = "Error: " . mysqli_error($connection);
    }

    // Close the prepared statement and the database connection
    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    // Redirect back to the job details page or wherever needed
    header("Location: job-details.php?id=$jobId");
    exit();
} else {
    // Redirect if the form is not submitted
    // Redirect if the form is not submitted
    header("Location: job-details.php");
    exit();
}
// Flush the output buffer
ob_end_flush();
