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
                    <h6 class="m-0 font-weight-bold text-primary text-left">Ekvity Add Category</h6>
                    <a href="category_view.php" class="btn btn-info ml-auto">Back</a>
                </div>
                <!-- Nested Row within Card Body -->
                <div class="row justify-content-center">

                    <div class="col-lg-9">

                        <div class="p-5">
                            <?php
                            if (isset($_GET['id'])) {
                                $category_id = $_GET['id'];
                                $category_edit = "SELECT * FROM categories WHERE id='$category_id'";
                                $query_run = mysqli_query($conn, $category_edit);

                                if (!$query_run) {
                                    die('Error in SQL query: ' . mysqli_error($conn));
                                }

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $category) {
                            ?>
                                        <form action="category_update.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $category['id']; ?>">
                                            <div class="main-form mt-3 border-bottom">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-4">
                                                            <input type="text" name="name" value="<?= $category['name']; ?>" class="form-control" required placeholder="Enter Department">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="paste-new-forms"></div>
                                            <div class="form-group mt-4">
                                                <div class="custom-control custom-checkbox small">
                                                    <input name="status" <?= $category['status'] == '1' ? 'checked' : '' ?> type="checkbox" class="custom-control-input" id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Status</label>
                                                </div>
                                            </div>
                                            <button type="submit" name="update_category_btn" class="btn btn-primary mt-4">Update
                                                Category</button>
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