<?php
session_start();
include("config/authentication.php");
include("config/connection.php");
// add blog

if(isset($_POST['save_multiple_data']))
{
   // Escape the values to prevent SQL injection
$blog_name = mysqli_real_escape_string($conn, $_POST['blog_name']);
$author = mysqli_real_escape_string($conn, $_POST['author']);
$blog_sub_title = mysqli_real_escape_string($conn, $_POST['blog_sub_title']);
$blog_desc = mysqli_real_escape_string($conn, $_POST['blog_desc']);
$date = mysqli_real_escape_string($conn, $_POST['date']);
 $status = isset($_POST['status']) ? 1 : 0;

    // Image Upload
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["blog_image"]["name"]);
$blog_img =  basename($_FILES["blog_image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is set and not empty
if (isset($_FILES["blog_image"]) && isset($_FILES["blog_image"]["tmp_name"]) && !empty($_FILES["blog_image"]["tmp_name"])) {
    $check = getimagesize($_FILES["blog_image"]["tmp_name"]);

    if ($check === false) {
        $uploadOk = 0;
    }
} else {
    $uploadOk = 0;
}

    // Check file size, file format, etc.
    if ($uploadOk == 0) {
        $_SESSION['status'] = "Image not uploaded. Check file type, size, and try again.";
        header("Location: blog_form.php");
        exit(0);
    } else {
        if (move_uploaded_file($_FILES["blog_image"]["tmp_name"], $target_file)) {
            // Image uploaded successfully, now insert data into the database

            // Start a transaction
            mysqli_begin_transaction($conn);

            // Insert main blog entry
            $query = "INSERT INTO blog (blog_name, author, blog_sub_title, blog_desc, blog_image, date, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssssssi", $blog_name, $author, $blog_sub_title, $blog_desc, $blog_img, $date, $status);
                $query_run = mysqli_stmt_execute($stmt);

                if ($query_run) {
                    $blog_id = mysqli_insert_id($conn);

                   // Handle blog details
                   $subtitle = $_POST['subtitle'];
                   $description = $_POST['description'];

                   foreach ($subtitle as $index => $subtitles) {
                       $s_name = mysqli_real_escape_string($conn, $subtitles);
                       $s_phone = mysqli_real_escape_string($conn, $description[$index]);

                       $query_details = "INSERT INTO blog_details (blog_id, subtitle, description) VALUES (?, ?, ?)";
                       $stmt_details = mysqli_prepare($conn, $query_details);

                       if ($stmt_details) {
                           mysqli_stmt_bind_param($stmt_details, "iss", $blog_id, $s_name, $s_phone);
                           $query_run_details = mysqli_stmt_execute($stmt_details);
                           mysqli_stmt_close($stmt_details);

                           if (!$query_run_details) {
                               echo "Error inserting blog details: " . mysqli_error($conn);
                           }
                       }
                   }

                    // Commit the transaction if everything is successful
                    mysqli_commit($conn);

                    $_SESSION['status'] = "Data Inserted Successfully";
                    header("Location: blog.php");
                    exit(0);
                } else {
                    mysqli_rollback($conn); // Rollback if main entry insertion fails
                    $_SESSION['status'] = "Data Not Inserted";
                    header("Location: blog.php");
                    exit(0);
                }
            }
        } else {
            $_SESSION['status'] = "Image upload failed. Try again later.";
            header("Location: blog.php");
            exit(0);
        }
    }
    // end od add blog

}
?>