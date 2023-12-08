<?php
session_start();
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

        <div class="table-responsive">

            <table class="table" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-light">
                        <th>Sr No</th>
                        <th>BlogName</th>
                        <th>AtuorName</th>
                        <th>Image</th>

                        <th>date</th>
                        <th>status</th>
                        <th>subtitle</th>
                        <th>description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Sr No</th>
                        <th>BlogName</th>
                        <th>AtuorName</th>
                        <th>Image</th>

                        <th>date</th>
                        <th>status</th>
                        <th>subtitle</th>
                        <th>description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
                <tbody>
                <?php 
                                        $query ="SELECT * FROM blog_entries";
                                        $query_run = mysqli_query($conn,$query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $row)
                                            {
                                                ?>
                            <tr>
                                <td><?= $row['blog_id']; ?></td>
                                <td><?= $row['blog_name']; ?></td>
                                <td><?= $row['author']; ?></td>
                                <td>
                                    <img src="<?= "uploads/" . $row['blog_image']; ?>" alt="Blog Image" style="max-width: 100px;">
                                </td>






                                <td><?= date('M j, Y', strtotime($row['date'])); ?></td>

                                <td><?= ($row['status'] == 1) ? 'Active' : 'Inactive'; ?></td>


                                <td><?= $row['subtitle']; ?></td>
                                <td><?= $row['description']; ?></td>
                                <td>
                                    <a class="btn btn-success btn-circle btn-sm" href="register_edit.php?id=<?= $row['blog_id']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="process.php" method="POST">
                                        <button type="submit" name="user_delete" value="<?= $row['blog_id']; ?>" class="btn btn-danger btn-circle btn-sm">
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