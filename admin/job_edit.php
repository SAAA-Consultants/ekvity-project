<?php
session_start();
include('config/authentication.php');
include('includes/header.php');
include('config/connection.php')
?>

<!-- Begin Page Content -->
<div class="container-fluid">

</div>
<div class="row justify-content-center">
    <div class="col-md-9">

        <?php 
                    if(isset($_SESSION['status']))
                    {
                        ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
                        unset($_SESSION['status']);
                    }
                ?>

        <div class="card mt-4">
            <div class="card-header">
                <h4>Add Ekvity Blog
                    <!-- <a href="javascript:void(0)" class="add-more-form float-end btn btn-primary">ADD MORE</a> -->
                </h4>
            </div>
            <?php
if (isset($_GET['id'])) {
    $job_id = $_GET['id'];

    // Create a new database connection
    $connection = mysqli_connect("localhost", "root", "", "blog_ekvity");

    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM job_requirements WHERE id = $job_id";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $job = mysqli_fetch_assoc($result);
    } else {
        echo "Job not found!";
        exit();
    }

    // Close the database connection
    mysqli_close($connection);
} else {
    echo "Invalid request!";
    exit();
}
?>

            <div class="card-body">

            <form action="job_update.php" method="POST" enctype="multipart/form-data">

<div class="main-form mt-3 border-bottom">
    <div class="row">
        <!-- Inside your form -->
        <div class="col-md-12">
        <input type="hidden" name="job_id" value="<?= $job['id'] ?>">
        <div class="form-group mb-4">
    <label for="category">Select Department:</label>
    <select name="category" class="form-control">
        <option value="">Select Department</option>
        <?php
        // Database connection
        $connection = mysqli_connect("localhost", "root", "", "blog_ekvity");

        // Check connection
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Query to select categories from the 'categories' table
        $query = "SELECT `id`,`name` FROM categories";
        // Perform the query
        $result = mysqli_query($connection, $query);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                ?>
                <option value="<?php echo $row['id'] ?>" <?php echo ($row['id'] == $job['category']) ? 'selected' : ''; ?>><?php echo $row['name'] ?></option>
                <?php
            }
        } else {
            echo "0 results";
        }

        $connection->close();
        ?>
    </select>
</div>
        </div>

        <div class="col-md-6">
            <div class="form-group mb-4">
                <input type="text" value="<?= $job['job_title'] ?>" name="job_title" class="form-control" required placeholder="Enter job title">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-4">
                <input type="text" name="location" value="<?= $job['location'] ?>" class="form-control" required placeholder="Enter job location">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-4">
                <input type="text" name="employment_type" value="<?= $job['employment_type'] ?>"   class="form-control" required placeholder="Enter employment_type">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group mb-4">
                <input type="date" name="date" value="<?= date('Y-m-d', strtotime($job['date'])) ?>"  class="form-control" required placeholder="Enter date">
            </div>
        </div>
    <?php
$details_query = "SELECT * FROM job_details WHERE job_id='$job_id'";
$details_run = mysqli_query($conn, $details_query);

if (!$details_run) {
    die('Error in SQL query for details: ' . mysqli_error($conn));
}

if (mysqli_num_rows($details_run) > 0) {
    foreach ($details_run as $key => $detail) {
    // New input fields for job_description, qualifications, and skills
        echo '<input type="hidden" name="detail_id[' . $key . ']" value="' . $detail['id'] . '">';
        echo '<div class="col-md-12">';
        echo '  <div class="form-group mb-4">';
        echo '      <label for="job_description">Update Job Description</label>';
        echo '      <input type="text" name="job_description[' . $key . ']" value="' . htmlspecialchars($detail['job_description']) . '" class="form-control" required placeholder="Enter Job Description">';
        echo '  </div>';
        echo '</div>';

        echo '<div class="col-md-12">';
        echo '  <div class="form-group mb-4">';
        echo '      <label for="qualifications">Update Qualifications</label>';
        echo '      <input type="text" name="qualifications[' . $key . ']" value="' . htmlspecialchars($detail['qualifications']) . '" class="form-control" required placeholder="Enter Qualifications">';
        echo '  </div>';
        echo '</div>';

        echo '<div class="col-md-12">';
        echo '  <div class="form-group mb-4">';
        echo '      <label for="skills">Update Skills</label>';
        echo '      <input type="text" name="skills[' . $key . ']" value="' . htmlspecialchars($detail['skills']) . '" class="form-control" required placeholder="Enter Skills">';
        echo '  </div>';
        echo '</div>';
    }
}
?>

    </div>
</div>

<div class="paste-new-forms"></div>
<div class="col-md-6 mt-4">
    <div class="form-group">
        <div class="custom-control custom-checkbox small">
        <input name="status" type="checkbox" <?php echo ($job['status'] == 1) ? 'checked' : ''; ?> class="custom-control-input" id="customCheck">

            <label class="custom-control-label" for="customCheck">Status</label>
        </div>
    </div>
</div>

<button type="submit" name="save_multiple_data" class="btn btn-primary mt-4">Update Job</button>
</form>

                        
                  
</div>
</div>
</div>


<?php include('includes/footer.php');?>