<?php
session_start();
include('config/authentication.php');
include('config/connection.php');
include('includes/header.php'); ?>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary text-left">Ekvity Add Employee</h6>
                    <a href="employee_view.php" class="btn btn-info ml-auto">Back</a>
                </div>
                <!-- Nested Row within Card Body -->
                <div class="row justify-content-center">

                    <div class="col-lg-9">

                        <div class="p-5">
                            <form action="employee_process.php" method="POST" enctype="multipart/form-data">
                                <div class="main-form mt-3 border-bottom">
                                    <div class="row">


                                        <input id="id" type="hidden" name="id" placeholder="Enter employeeName" class="form-control" required autocomplete="off" />


                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="name">Name:</label>
                                                <input id="name" type="text" name="name" placeholder="Enter employeeName" class="form-control" required autocomplete="name" />

                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="designation">Designation:</label>
                                                <input id="designation" type="text" name="designation" class="form-control" placeholder="Enter employee designation" required autocomplete="designation" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="category">Department</label>
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
                                                        while ($row = $result->fetch_assoc()) { ?>
                                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                                    <?php
                                                        }
                                                    } else {
                                                        echo "0 results";
                                                    }

                                                    $conn->close();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="gender">Gender:</label>
                                                <select id="gender" name="gender" class="form-control">
                                                    <option>Select gender</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="female">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-4">
                                                <label for="description">Description</label>
                                                <textarea id="description" name="description" placeholder="Enter employee description" class="form-control" cols="30" rows="10"></textarea>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="image">Image</label>
                                                <input id="image" type="file" name="image" class="form-control" required autocomplete="image" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="date">Date:</label>
                                                <input id="date" type="date" name="date" class="form-control" required autocomplete="date" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="team_id">Employee ID</label>
                                                <input id="team_id" type="number" name="team_id" class="form-control" placeholder="Enter Employee ID" required autocomplete="team_id" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Status:</label>
                                                <select id="status" name="status" class="form-control">
                                                    <option>Select status</option>
                                                    <option value="current">Current</option>
                                                    <option value="past">Past</option>
                                                </select>
                                            </div>

                                        </div>


                                    </div>
                                </div>


                                <button type="submit" name="add_employee_btn" class="btn btn-primary mt-4">Add employee</button>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>
</body>