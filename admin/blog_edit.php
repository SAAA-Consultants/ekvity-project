<?php
session_start();
include('config/authentication.php');
include('config/connection.php');
include('includes/header.php');?>

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
                <?php 
                        if(isset($_GET['id'])){
                            $user_id = $_GET['id'];
                            $users = "SELECT * FROM blog WHERE id='$user_id'";
                            $users_run= mysqli_query($conn,$users);

                            if (!$users_run) {
                                die('Error in SQL query: ' . mysqli_error($conn));
                            }

                if(mysqli_num_rows($users_run) > 0)
                {
                    foreach($users_run as $user)
                    {
                        ?>

                <form action="blog_update.php" method="POST" class="user" enctype="multipart/form-data">
                    <div class="form-group"> 
                    <input type="hidden" name="id" value="<?php echo $user_id; ?>">

                    </div>


                    <div class="form-group">
                        <div class="col-md-12 ">
                            <input id="blog_name" type="text" name="blog_name" value="<?=$user['blog_name'];?>"
                                class="form-control form-control"  placeholder="Blog Name"
                                required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input id="author" type="text" name="author" value="<?=$user['author'];?>"
                                class="form-control form-control"  placeholder="author">
                        </div>
                        </div>
                    <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <input type="text" name="blog_sub_title" value="<?=$user['blog_sub_title'];?>" class="form-control" required
                                        placeholder="Enter blog_sub_title">

                                </div>
                            </div>
                    <div class="col-md-12">
                                <div class="form-group mb-4">
                                <textarea name="blog_desc" class="form-control" id="" cols="30" rows="10" placeholder="Enter Blog Desc"><?=$user['blog_desc'];?></textarea>
                              </div>
                            </div>

                    <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <label for="blog_image">Upload Image:</label>
                                    <input type="file" name="blog_image" class="form-control">

                                    <?php
        // Display the current image if available
        if (!empty($user['blog_image'])) {
            echo "<img src='uploads/{$user['blog_image']}' alt='blog Image' class='mt-2' style='max-width: 100px;'>";

        }
        ?>
                                </div>
                            </div>
                            <!-- <div class="form-group">
    <div class="col-md-12">
        <label for="date">Date:</label>
        <input type="date" name="date" value="<?= date('Y-m-d', strtotime($user['date'])) ?>"  class="form-control" required placeholder="Enter date">
    </div>
</div> -->


                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                        <div class="custom-control custom-checkbox small">
                            <input name="status" <?= $user['status'] == '1' ? 'checked' : '' ?> type="checkbox"
                                class="custom-control-input" id="customCheck">
                            <label class="custom-control-label" for="customCheck">Status</label>
                        </div>
                        </div>
                    </div>
                    <?php
$details_query = "SELECT * FROM blog_details WHERE blog_id='$user_id'";
$details_run = mysqli_query($conn, $details_query);

if (!$details_run) {
    die('Error in SQL query for details: ' . mysqli_error($conn));
}

if (mysqli_num_rows($details_run) > 0) {
    foreach ($details_run as $key => $detail) {
        echo '<div class="col-md-12">';
        echo '  <div class="form-group mb-4">';
        echo '      <label for="subtitle">Update Subtitle</label>';
        echo '      <input type="text" name="subtitle[' . $key . ']" value="' . htmlspecialchars($detail['subtitle']) . '" class="form-control" required placeholder="Enter Subtitle">';
        echo '      <input type="hidden" name="detail_id[' . $key . ']" value="' . $detail['id'] . '">';
        echo '  </div>';
        echo '</div>';
        echo '<div class="col-md-12">';
        echo '  <div class="form-group mb-4">';
        echo '      <label for="description">Update Description</label>';
        echo '      <input type="text" name="description[' . $key . ']" value="' . htmlspecialchars($detail['description']) . '" class="form-control" required placeholder="Enter Sub-Description">';
        echo '  </div>';
        echo '</div>';
    }
}
?>

                    <div class="form-group">
                        <button type="submit" name="update_blog" class="btn btn-primary btn-user btn-block">
                            Update User
                        </button>
                    </div>

                    <hr>

                </form>

                <?php
                        
                    }
               

                } else 
                {
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


<?php include('includes/footer.php');?>