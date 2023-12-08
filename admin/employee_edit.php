<?php
session_start();
include('config/connection.php');
include('includes/header.php'); ?>
<body class="bg-gradient-primary">

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary text-left">Ekvity Edit Employee</h6>
    <a href="employee_view.php" class="btn btn-info ml-auto">Back</a>
</div>
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-center">
               
                <div class="col-lg-9">
                <?php 
                    if(isset($_SESSION['message']))
                    {
                        ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Hey!</strong> <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
                        unset($_SESSION['message']);
                    }
                ?>
                    <div class="p-5">
                    <?php
                            if (isset($_GET['id'])) {
                                $category_id = $_GET['id'];
                                $category_edit = "SELECT * FROM employees WHERE id='$category_id'";
                                $query_run = mysqli_query($conn, $category_edit);

                                if (!$query_run) {
                                    die('Error in SQL query: ' . mysqli_error($conn));
                                }

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $category) {
                            ?>
    <form action="employee_update.php" method="POST" enctype="multipart/form-data">
        <div class="main-form mt-3 border-bottom">
            <div class="row">
            <input type="hidden" name="id" value="<?= $category['id']; ?>" />
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="name">Name:</label>
                        <input type="text" name="name" value="<?= $category['name']; ?>" class="form-control" required />
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="designation">Designation:</label>
                        <input type="text" name="designation" value="<?= $category['designation']; ?>"  class="form-control"  required />
                    </div>
                </div>
                <div class="col-md-6">
    <div class="form-group" >
        <label for="category">Department</label>
        <select name="category" class="form-control">
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
        while ($row = $result->fetch_assoc()) {
            // Check if the category ID matches the one stored in the employee data
            $selected = ($row['id'] == $category_id) ? 'selected' : '';
            ?>
            <option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['name'] ?></option>
        <?php
        }
    } else {
        echo "0 results";
    }

    $connection->close(); // Close the connection properly
    ?>
</select>

    </div>
</div>

<div class="col-md-6">
                    <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" class="form-control">
    <option>Select gender</option>
    <option value="male" <?php echo ($category['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
    <option value="female" <?php echo ($category['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
    <option value="other" <?php echo ($category['gender'] == 'other') ? 'selected' : ''; ?>>Other</option>
</select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mb-4">
                        <label for="description">Description</label>
                        <textarea id="description" name="description"  class="form-control"  cols="30" rows="10"><?= $category['description']; ?></textarea>
                        
                    </div>
                </div>
                <div class="col-md-6">
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" class="form-control"  />
        <?php
        // Display the current image if available
        if (!empty($category['image'])) {
            echo "<img src='teamimage/{$category['image']}' alt='Employee Image' class='mt-2' style='max-width: 100px;'>";
        }
        ?>
    </div>
</div>

                <div class="col-md-6">
    <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" name="date" class="form-control"  value="<?= $category['date']; ?>" required />
    </div>
</div>

                <div class="col-md-6">
    <div class="form-group">
        <label for="team_id">Employee ID</label>
        <input type="number" name="team_id" class="form-control"  value="<?= $category['team_id']; ?>"  required />
    </div>
</div>

                <div class="col-md-6">
    <div class="form-group">
        <label for="status">Status:</label>
        <select name="status" class="form-control">
            <option>Select status</option>
            <option value="current" <?= ($category['status'] == 'current') ? 'selected' : ''; ?>>Current</option>
            <option value="past" <?= ($category['status'] == 'past') ? 'selected' : ''; ?>>Past</option>
        </select>
    </div>
</div>

            
                
            </div>
        </div>
       

        <button type="submit" name="update_employee_btn" class="btn btn-primary mt-4">Update employee</button>

    </form>
    <?php

                                    }
                                } else {
                                    ?>
                                    <h4>No Records Found</h4>
                            <?php
                                }
                            }

                            ?>
</div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
</body>