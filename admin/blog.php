<?php
session_start();
include('config/authentication.php');
include('config/connection.php');
include('includes/header.php'); ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary text-left">Ekvity Blog</h6>
        <a href="blog_form.php" class="btn btn-primary ml-auto">+ Add Blog</a>
    </div>

    <div class="card-body">

        <?php include('message.php'); ?>
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
        <div class="table-responsive">

            <table class="table" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-light">
                        <th>Sr No</th>
                        <th>BlogName</th>
                        <th>AtuorName</th>
                        <th>Description</th>
                        <th>Image</th>

                        <th>date</th>
                        <th>status</th>

                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Sr No</th>
                        <th>BlogName</th>
                        <th>AtuorName</th>
                        <th>Description</th>
                        <th>Image</th>

                        <th>date</th>
                        <th>status</th>

                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php 
                                        $query ="SELECT * FROM blog";
                                        $query_run = mysqli_query($conn,$query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $row)
                                            {
                                                ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['blog_name']; ?></td>
                        <td><?= $row['author']; ?></td>
                        <td><?= $row['blog_desc']; ?></td>
                        <td>
                            <img src="<?= "uploads/" , $row['blog_image']; ?>" alt="Blog Image" style="max-width: 80px; max-height: 50px">

                        </td>






                        <td><?= date('M j, Y', strtotime($row['created_at'])); ?></td>

                        <td><?= ($row['status'] == 1) ? 'Active' : 'Inactive'; ?></td>



                        <td>
                            <a class="btn btn-success btn-circle btn-sm" href="blog_edit.php?id=<?= $row['id']; ?>">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <form action="blog_update.php" method="POST">
                                <button type="submit" name="blog_delete" value="<?= $row['id']; ?>"
                                    class="btn btn-danger btn-circle btn-sm">
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
                        <td colspan="11">No Records Found</td>
                    </tr>
                    <?php
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