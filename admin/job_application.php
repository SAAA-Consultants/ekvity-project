<?php
session_start();
include('config/connection.php');
include('includes/header.php'); ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary text-left">Job Application</h6>

    </div>

    <div class="card-body">

        <?php include('message.php'); ?>
        <?php
        if (isset($_SESSION['status'])) {
        ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            unset($_SESSION['status']);
        }
        ?>
        <div class="table-responsive">

            <table class="table" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-light">
                        <th>Sr No</th>
                        <th>JobTitle</th>
                        <th>FirstName</th>
                        <th>LastName</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Location</th>
                        <th>Resume</th>
                        <th>Delete</th>

                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Sr No</th>
                        <th>JobTitle</th>
                        <th>FirstName</th>
                        <th>LastName</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Location</th>
                        <th>Resume</th>
                        <th>Delete</th>

                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $query = "SELECT job_applications.*, job_requirements.job_title 
          FROM job_applications 
          JOIN job_requirements ON job_applications.job_id = job_requirements.id";
                    $query_run = mysqli_query($conn, $query);

                    if ($query_run) {
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                    ?>
                                <tr>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['job_title']; ?></td>
                                    <td><?= $row['first_name']; ?></td>
                                    <td><?= $row['last_name']; ?></td>
                                    <td><?= $row['email']; ?></td>
                                    <td><?= $row['contact']; ?></td>
                                    <td><?= $row['location']; ?></td>
                                    <td>
                                        <a href="/ekvity-admin-panel/admin/resume/<?= $row['resume_path']; ?>" target="_blank" download="<?= $row['resume_path']; ?>">
                                            View/Download Resume
                                        </a>




                                    </td>


                                    <td>
                                        <form action="job_application_delete.php" method="POST">
                                            <button type="submit" name="job_application_delete" value="<?= $row['id']; ?>" class="btn btn-danger btn-circle btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="8">No Records Found</td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                    ?>
                </tbody>
            </table>
        </div>








        </tbody>
        </table>
    </div>
</div>
</div>
<?php include('includes/footer.php'); ?>