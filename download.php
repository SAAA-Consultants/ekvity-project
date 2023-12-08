<?php
// download.php

if (isset($_GET['id'])) {
    $jobId = $_GET['id'];

    // Retrieve the file path from the database based on $jobId
    $connection = mysqli_connect("localhost", "root", "", "blog_ekvity");

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT pdf_upload FROM job_requirements WHERE id = $jobId";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Extract the actual file name from the file path
        $file_path = "admin/pdfuploads/" . basename($row['pdf_upload']);

        if (file_exists($file_path)) {
            // Set headers for download
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_path));
            readfile($file_path);
            exit;
        } else {
            echo "File not found";
        }
    } else {
        echo "No record found for the given Job ID";
    }

    mysqli_close($connection);
} else {
    echo "Job ID not provided";
}
?>
