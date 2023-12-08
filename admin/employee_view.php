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
        <img src="./img/heading-1.svg" alt=""> Employee <img src="./img/heading-2.svg" alt="">
    </h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary text-left">Ekvity Employees</h6>
            <a href="carrier.php" class="btn btn-primary ml-auto">+ Add Employee</a>
        </div>

        <div class="card-body">
            <?php include('message.php'); ?>
            <div class="table-responsive">
                <table class="table " id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="bg-light">
                            <th>Sr</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Department</th>
                            <th>Gender</th>

                            <th>Image</th>
                            <th>Date</th>
                            <th>Team-Id</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sr</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Department</th>
                            <th>Gender</th>

                            <th>Image</th>
                            <th>Date</th>
                            <th>Team-Id</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM employees";
                        $query_run = mysqli_query($conn, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                        ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['designation']; ?></td>
                            <td><?= $row['category']; ?></td>
                            <td><?= $row['gender']; ?></td>

                            <td><img src='teamimage/<?= $row['image']; ?>' alt='Employee Image'
                                    style="max-width: 80px; max-height: 50px"></td>
                            <td><?= $row['date']; ?></td>
                            <td><?= $row['team_id']; ?></td>
                            <td><?= $row['status']; ?></td>
                            <td> <a class="btn btn-success btn-circle btn-sm"
                                    href="employee_edit.php?id=<?= $row['id']; ?>"> <i class="fas fa-edit"></i></a></td>
                            <td>
                                <form action="employee_update.php" method="POST">
                                    <button type="submit" name="employee_delete" value="<?= $row['id']; ?>"
                                        class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button>

                                </form>

                            </td>

                        </tr>
                        <?php

                            }
                        } else {
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

<?php include('includes/footer.php'); ?>