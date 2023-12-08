<?php
session_start();
include('config/authentication.php');
include('config/connection.php');
include('includes/header.php');


?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 style="color: rgba(34, 54, 108, 1); font-family:Tenor Sans-Regular, Helvetica;font-weight: 400;font-size:2.5rem; "
        class="h3 mb-2 text-center mb-4">
        <img src="./img/heading-1.svg" alt=""> Job <img src="./img/heading-2.svg" alt="">
    </h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary text-left">Ekvity Job</h6>
            <a href="job_add.php" class="btn btn-primary ml-auto">+ Add Job</a>
        </div>

        <div class="card-body">
            <?php include('message.php');?>
            <div class="table-responsive">
                <table class="table " id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="bg-light">
                        <th>Sr</th>
                        <th>Job title</th>
                <!-- <th>Category</th> -->
                <th>Location</th>
                <th>Employee Type</th>
                <th>Date</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>Sr</th>
                        <th>Job title</th>
                <!-- <th>Category</th> -->
                <th>Location</th>
                <th>Employee Type</th>
                <th>Date</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php 
                                        $query ="SELECT * FROM job_requirements";
                                        $query_run = mysqli_query($conn,$query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $row)
                                            {
                                                ?>
                        <tr>
                        <td><?= $row['id']; ?></td>
            <td><?= $row['job_title']; ?></td>
            <!-- <td><?= $row['category']; ?></td> -->
            <td><?= $row['location']; ?></td>
            <td><?= $row['employment_type']; ?></td>
            <td><?= $row['date']; ?></td>
            <td><?= ($row['status'] == 1) ? 'Active' : 'Inactive'; ?></td>
                            <td> <a class="btn btn-success btn-circle btn-sm"
                                    href="job_edit.php?id=<?=$row['id'];?>"> <i class="fas fa-edit"></i></a></td>
                            <td>
                                <form action="delete_job.php" method="POST">
                                    <button type="submit" name="job_delete" value="<?=$row['id'];?>"
                                        class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button>

                                </form>

                            </td>

                        </tr>
                        <?php

                                            }
                                        }
                                        else
                                        {
                                            ?>
                        <td colspan="7">No Records Found</td>
                        <?php
                                        }
                                        ?>







                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include('includes/footer.php');?>