<?php
session_start();
include('config/authentication.php');
include('includes/header.php');?>
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
            <div class="card-body">

            <form action="job_process.php" method="POST" enctype="multipart/form-data">

<div class="main-form mt-3 border-bottom">
    <div class="row">
        <!-- Inside your form -->
        <div class="col-md-12">
            <div class="form-group mb-4">
                <label for="category">Select Department:</label>
                <select id="category" name="category" class="form-control">
                    <option>Select Department</option>
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
                        while($row = $result->fetch_assoc()) {
                    ?>
                            <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
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
        <label for="job_title">Job Title:</label>
        <input id="job_title" type="text"  name="job_title" class="form-control" required placeholder="Enter job title" />
    </div>
</div>

        <div class="col-md-6">
    <div class="form-group mb-4">
        <label for="location">Job Location:</label>
        <input id="location" type="text"  name="location" class="form-control" required placeholder="Enter job location" />
    </div>
</div>

        <div class="col-md-6">
            <div class="form-group mb-4">
            <label for="employment_type">Employment_type</label>
                <input id="employment_type" type="text" name="employment_type" class="form-control" required placeholder="Enter employment_type" />
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group mb-4">
            <label for="date">Add Date</label>
                <input id="date" type="date" name="date" class="form-control" required placeholder="Enter date" />
            </div>
        </div>
    
        <div class="col-md-6">
            <div class="form-group mb-4">
                <input id="notice_period" type="text" name="notice_period" class="form-control" required placeholder="Enter Notice period" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-4">
                <input id="pdf_upload" type="file" name="pdf_upload" class="form-control" />
            </div>
        </div>

        <div class="col-md-3">
    <div class="form-group mb-2">
        <input type="text" name="job_description[]" class="form-control" required placeholder="Enter job_description" />
    </div>
</div>

<div class="col-md-1">
    <div class="form-group mb-4">
        <a href="javascript:void(0)" class="add-more-subtitle float-end btn btn-success">+</a>
    </div>
</div>
<div class="col-md-3">
    <div class="form-group mb-4">
    <input type="text" name="qualifications[]" class="form-control" required placeholder="Enter qualifications" />
    </div>
</div>
<div class="col-md-1">
    <div class="form-group mb-4">
        <a href="javascript:void(0)" class="add-more-qualifications float-end btn btn-success">+</a>
    </div>
</div>
<div class="col-md-3">
    <div class="form-group mb-2">
        <input type="text" name="skills[]" class="form-control" required placeholder="Enter Skill" />
    </div>
</div>

<div class="col-md-1">
    <div class="form-group mb-4">
        <a href="javascript:void(0)" class="add-more-skills float-end btn btn-success">+</a>
    </div>
</div>
    </div>
</div>

<div class="paste-new-forms"></div>
<div class="col-md-6 mt-4">
    <div class="form-group">
        <div class="custom-control custom-checkbox small">
        <input name="status" type="checkbox" class="custom-control-input" id="customCheck">

            <label class="custom-control-label" for="customCheck">Status</label>
        </div>
    </div>
</div>


<button type="submit" name="save_multiple_data" class="btn btn-primary mt-4">Add Blog</button>
</form>

</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
$(document).ready(function() {
    var maxFields = 6; // Maximum input fields allowed
    var wrapper = $('.paste-new-forms');
    var subtitleCount = 1;
    var qualificationsCount = 1;
    var skillsCount = 1;

    // Add subtitle fields
    $('.add-more-subtitle').click(function(e) {
        e.preventDefault();
        if (subtitleCount < maxFields) {
            subtitleCount++;
            appendField('job_description', 'Enter job_description', 'remove-btn-subtitle');
        }
    });

    // Add skills fields
    $('.add-more-skills').click(function(e) {
        e.preventDefault();
        if (skillsCount < maxFields) {
            skillsCount++;
            appendField('skills', 'Enter Skill', 'remove-btn-skills');
        }
    });

    // Add qualifications fields
    $('.add-more-qualifications').click(function(e) {
        e.preventDefault();
        if (qualificationsCount < maxFields) {
            qualificationsCount++;
            appendField('qualifications', 'Enter qualifications', 'remove-btn-add-more-qualifications');
        }
    });

  // Function to append a new field
function appendField(fieldName, placeholder, removeBtnClass) {
    $(wrapper).append('<div class="main-form mt-3  border-bottom">\
        <div class="row">\
            <div class="col-md-10">\
                <div class="form-group mb-4">\
                    <input type="text" name="' + fieldName + '[]" class="form-control" required placeholder="' + placeholder + '">\
                </div>\
            </div>\
            <div class="col-md-2">\
                <div class="form-group mb-4">\
                    <button type="button" class="' + removeBtnClass + ' btn btn-danger">-</button>\
                </div>\
            </div>\
        </div>\
    </div>');
}


    // Remove fields
    $(wrapper).on('click', '.remove-btn-subtitle', function() {
        $(this).closest('.main-form').remove();
        subtitleCount--;
    });

    $(wrapper).on('click', '.remove-btn-skills', function() {
        $(this).closest('.main-form').remove();
        skillsCount--;
    });

    $(wrapper).on('click', '.remove-btn-add-more-qualifications', function() {
        $(this).closest('.main-form').remove();
        qualificationsCount--;
    });
});

</script>
<?php include('includes/footer.php');?>