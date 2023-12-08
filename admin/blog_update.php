<?php
session_start();
include("config/authentication.php");
include("config/connection.php");



// Update blog
if (isset($_POST['update_blog'])) {
    $user_id = $_POST['id'];
    $blog_name = $_POST['blog_name'];
    $author = $_POST['author'];
    $blog_sub_title = $_POST['blog_sub_title'];
    $blog_desc = $_POST['blog_desc'];
    $date = date('Y-m-d', strtotime($_POST['date']));
    $status = isset($_POST['status']) && $_POST['status'] ? '1' : '0';

    // Check if a new image is provided
    if (isset($_FILES['blog_image']) && $_FILES['blog_image']['error'] == 0) {
        $image = mysqli_real_escape_string($conn, $_FILES['blog_image']['name']);
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['blog_image']['name']);

        if (move_uploaded_file($_FILES['blog_image']['tmp_name'], $target_file)) {
            echo "File moved successfully!";
        } else {
            echo "Error moving file.";
        }
    } else {
        // No new image provided, fetch the existing image value
        $existing_image_query = "SELECT blog_image FROM blog WHERE id = '$user_id'";
        $existing_image_result = mysqli_query($conn, $existing_image_query);

        if ($existing_image_result === false) {
            // Handle the case where the query fails
            echo "Query failed: " . mysqli_error($conn);
            $_SESSION['message'] = "Error fetching existing image for blog ID: $user_id";
            header("Location: blog.php?id=$user_id");  // Update the location to your actual edit page
            exit();
        }

        if (mysqli_num_rows($existing_image_result) > 0) {
            $existing_image_row = mysqli_fetch_assoc($existing_image_result);
            $image = mysqli_real_escape_string($conn, $existing_image_row['blog_image']);
        } else {
            // Handle the case where no rows are returned
            echo "No rows returned for blog ID: $user_id";
            $_SESSION['message'] = "No existing image found for blog ID: $user_id";
            header("Location: blog.php?id=$user_id");  // Update the location to your actual edit page
            exit();
        }
    }

    // Update the database without modifying the image path
$query = "UPDATE blog SET 
           blog_name=?, 
           author=?,
           blog_sub_title=?,
           blog_desc=?,
           date=?, 
           status=?,
           blog_image=?
           WHERE id=?";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ssssissi", $blog_name, $author, $blog_sub_title, $blog_desc, $date, $status, $image, $user_id);

// Debugging: Check the update query
echo "Update Query: {$query}, Date: {$date}";

    $query_run = mysqli_stmt_execute($stmt);
   // Update blog details
   foreach ($_POST['subtitle'] as $key => $subtitle) {
    $detail_id = $_POST['detail_id'][$key];
    $subtitle_value = $_POST['subtitle'][$key];
    $description = $_POST['description'][$key];

    $update_details_query = "UPDATE blog_details SET subtitle=?, description=? WHERE id=?";
    $stmt_details = mysqli_prepare($conn, $update_details_query);
    mysqli_stmt_bind_param($stmt_details, "ssi", $subtitle_value, $description, $detail_id);
    $update_details_result = mysqli_stmt_execute($stmt_details);
    mysqli_stmt_close($stmt_details);

    if (!$update_details_result) {
        $_SESSION['message'] = "Error updating blog details: " . mysqli_error($conn);
        header("Location: blog.php?id=$user_id");
        exit();
    }
}

    if ($query_run) {
        echo "Query executed successfully!";
        $_SESSION['message'] = "Updated Successfully";
        header('Location: blog.php');
        exit(0);
    } else {
        echo "Error executing query: " . mysqli_error($conn);
        $_SESSION['message'] = "Error updating blog information: " . mysqli_error($conn);
        header('Location: blog.php');
        exit(0);
    }

    // Debugging: Check if this block is reached
    echo "Error executing query: " . mysqli_error($conn);

    mysqli_stmt_close($stmt);
}
// end of update blog











// delete th user
if(isset($_POST['blog_delete']))
{
    $user_id = $_POST['blog_delete'];

    $query = "DELETE FROM blog WHERE id='$user_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Admin/blog Delete succesfully";
        header("Location: blog.php");
        exit(0);

    } else
    {
        $_SESSION['message'] = "Something went wrong..!";
        header("Location: blog.php");
        exit(0);
    }

}

?>
