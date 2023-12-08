<?php
session_start();
include('config/connection.php');

if(isset($_POST['save_multiple_data']))
{
    // Handle blog information
    $blog_name = mysqli_real_escape_string($conn, $_POST['blog_name']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $status = isset($_POST['status']) ? 1 : 0;

    // Image Upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["blog_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (isset($_FILES["blog_image"]) && isset($_FILES["blog_image"]["tmp_name"]) && !empty($_FILES["blog_image"]["tmp_name"])) {
        $check = getimagesize($_FILES["blog_image"]["tmp_name"]);

        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    } else {
        $uploadOk = 0;
    }

    // Check file size, file format, etc.
    // ... (Your existing validation code)

    if ($uploadOk == 0) {
        $_SESSION['status'] = "Image not uploaded. Check file type, size, and try again.";
        header("Location: blog_form.php");
        exit(0);
    } else {
        if (move_uploaded_file($_FILES["blog_image"]["tmp_name"], $target_file)) {
            // Image uploaded successfully, now insert data into the database
            $query = "INSERT INTO blog_entries (blog_name, author, blog_image, date, status) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssssi", $blog_name, $author, $target_file, $date, $status);
                $query_run = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                if ($query_run) {
                    // Get the ID of the inserted blog entry
                    $blog_id = mysqli_insert_id($conn);

                    // Handle blog details
                    $subtitle = $_POST['subtitle'];
                    $description = $_POST['description'];

                    foreach ($subtitle as $index => $subtitles) {
                        $s_name = mysqli_real_escape_string($conn, $subtitles);
                        $s_phone = mysqli_real_escape_string($conn, $description[$index]);

                        $query_details = "INSERT INTO blog_entries (blog_id, subtitle, description) VALUES (?, ?, ?)";
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

                    $_SESSION['status'] = "Data Inserted Successfully";
                    header("Location: blog_form.php");
                    exit(0);
                } else {
                    $_SESSION['status'] = "Data Not Inserted";
                    header("Location: blog_form.php");
                    exit(0);
                }
            }
        } else {
            $_SESSION['status'] = "Image upload failed. Try again later.";
            header("Location: blog_form.php");
            exit(0);
        }
    }
}
?><?php
session_start();
include('config/connection.php');

if(isset($_POST['save_multiple_data']))
{
    // Handle blog information
    $blog_name = mysqli_real_escape_string($conn, $_POST['blog_name']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $status = isset($_POST['status']) ? 1 : 0;

    // Image Upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["blog_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (isset($_FILES["blog_image"]) && isset($_FILES["blog_image"]["tmp_name"]) && !empty($_FILES["blog_image"]["tmp_name"])) {
        $check = getimagesize($_FILES["blog_image"]["tmp_name"]);

        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    } else {
        $uploadOk = 0;
    }

    // Check file size, file format, etc.
    // ... (Your existing validation code)

    if ($uploadOk == 0) {
        $_SESSION['status'] = "Image not uploaded. Check file type, size, and try again.";
        header("Location: blog_form.php");
        exit(0);
    } else {
        if (move_uploaded_file($_FILES["blog_image"]["tmp_name"], $target_file)) {
            // Image uploaded successfully, now insert data into the database
            $query = "INSERT INTO blog (blog_name, author, blog_image, date, status) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssssi", $blog_name, $author, $target_file, $date, $status);
                $query_run = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                if ($query_run) {
                    // Get the ID of the inserted blog entry
                    $blog_id = mysqli_insert_id($conn);

                    // Handle blog details
                    $subtitle = $_POST['subtitle'];
                    $description = $_POST['description'];

                    foreach ($subtitle as $index => $subtitles) {
                        $s_name = mysqli_real_escape_string($conn, $subtitles);
                        $s_phone = mysqli_real_escape_string($conn, $description[$index]);

                        $query_details = "INSERT INTO blog_entries (blog_id, subtitle, description) VALUES (?, ?, ?)";
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

                    $_SESSION['status'] = "Data Inserted Successfully";
                    header("Location: blog_page.php");
                    exit(0);
                } else {
                    $_SESSION['status'] = "Data Not Inserted";
                    header("Location: blog_page.php");
                    exit(0);
                }
            }
        } else {
            $_SESSION['status'] = "Image upload failed. Try again later.";
            header("Location: blog_page.php");
            exit(0);
        }
    }
}
?>