<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog_ekvity";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $jobId = $_GET['id'];

    // Fetch job details based on the job ID
    $query = "SELECT * FROM job_requirements WHERE id = $jobId";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            // Fetch and display job details from job_details
            $queryDetails = "SELECT * FROM job_details WHERE job_id = $jobId";
            $resultDetails = mysqli_query($conn, $queryDetails);

            if ($resultDetails && mysqli_num_rows($resultDetails) > 0) {
                while ($rowDetails = mysqli_fetch_assoc($resultDetails)) {
                    // Create the string with the desired text content
                    $textContent = "
                        Job Title: " . $row['job_title'] . "
                        Date: " . date("jS F Y", strtotime($row['date'])) . "
                        Job Description: " . $rowDetails['job_description'] . "
                        Qualifications: " . $rowDetails['qualifications'] . "
                        Skills: " . $rowDetails['skills'] . "
                        Employment: " . $row['employment_type'] . "
                        Gender Preferred: No preference
                        Notice Period: " . $row['notice_period'] . "
                        About Ekvity: We are a leading Financial Services provider that mainly emphasizes on Tailor made solutions in the areas of Unlisted/Pre-IPO Shares, Wealth Management, Insurance Planning, and Mutual Funds. We offer customized solutions to our clients that allow them to meet their strategic financial objectives. Through our bespoke financing solutions, we enable our clients to pursue ambitious growth strategies and execute value-creating transactions.
                    ";

                    // Return the text content
                    echo $textContent;
                }
            } else {
                echo "No additional job details found";
            }

            // Rest of your code
        } else {
            echo "Job not found";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Job ID not provided";
}

$conn->close();
?>
