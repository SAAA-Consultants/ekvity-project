<?php
require_once 'mpdf/vendor/autoload.php';

if (isset($_GET['id'])) {
    $jobId = $_GET['id'];

    // Establish your database connection here
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blog_ekvity";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch job details based on the job ID
    $query = "SELECT * FROM job_requirements WHERE id = $jobId";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            // Create PDF
            $mpdf = new \Mpdf\Mpdf();

            $html = '<html>';
            $html .= '<head><meta charset="utf-8"></head>';
            $html .= '<body>';
            $html .= '<div class="text-wrapper">';
            $html .= '<h4>' . $row['job_title'] . '</h4>';
            $html .= '<span>' . date("jS F Y", strtotime($row['date'])) . '</span>';
            $html .= '</div>';
            $html .= '<div class="job-description">';
            $html .= '<h3>Job Description</h3>';
            $html .= '<p class="understanding-the">' . $row['job_description'] . '</p>';
            $html .= '</div>';
            // Add other job details as needed
            $html .= '</body>';
            $html .= '</html>';

            $mpdf->WriteHTML($html);

            // Output PDF
            $mpdf->Output("JobDetails_$jobId.pdf", 'D');
        } else {
            echo "Job not found";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    $conn->close();
} else {
    echo "Job ID not provided";
}
?>
