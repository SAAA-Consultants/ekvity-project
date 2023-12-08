<?php
session_start();
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

                        <form action="blog_process.php" method="POST" enctype="multipart/form-data">
                        
                            <div class="main-form mt-3 border-bottom">
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group mb-4">
                                           <input type="text" name="blog_name" class="form-control" required placeholder="Enter Blog Name">
                                        </div>
                                    </div>
                                <div class="col-md-6">
                                        <div class="form-group mb-4">
                                           <input type="text" name="author" class="form-control" required placeholder="Enter Author Name">
                                        </div>
                                    </div>
                                <div class="col-md-6">
                                <div class="form-group mb-4">
            <label for="blog_image">Upload Image:</label>
            <input type="file" name="blog_image" class="form-control" required>
        </div>
                                    </div>
                                <div class="col-md-6">
                                        <div class="form-group mb-4">
                                        <label for="date">Add date</label>
                                        <input type="date" name="date" class="form-control" required placeholder="Enter date">

                                        </div>
                                    </div>
                                    
                                    <div class="col-md-5">
                                        <div class="form-group mb-2">
                                           
                                            <input type="text" name="subtitle[]" class="form-control" required placeholder="Enter Title">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group mb-4">
                                           
                                            <input type="text" name="description[]" class="form-control" required placeholder="Enter Subtitle">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mb-4 ">
                                            
                                        <a href="javascript:void(0)" class="add-more-form float-end btn btn-success">+</a>

                                        </div>
                                    
                                    </div>
                                </div>
                            </div>

                            <div class="paste-new-forms"></div>
                            <div class="col-md-6 mt-4">
                            <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                       <input name="status"  type="checkbox" class="custom-control-input" id="customCheck">
                                          <label class="custom-control-label" for="customCheck">Status</label>
                               </div>
                                    </div>

                            </div>

                            

                            <button type="submit" name="save_multiple_data" class="btn btn-primary mt-4">Save Multiple Data</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

   
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function () {

            $(document).on('click', '.remove-btn', function () {
                $(this).closest('.main-form').remove();
            });
            
            $(document).on('click', '.add-more-form', function () {
                $('.paste-new-forms').append('<div class="main-form mt-3 border-bottom">\
                                <div class="row">\
                                    <div class="col-md-5">\
                                        <div class="form-group mb-4">\
                                             <input type="text" name="subtitle[]" class="form-control" required placeholder="Enter Name">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-5">\
                                        <div class="form-group mb-4">\
                                            <input type="text" name="description[]" class="form-control" required placeholder="Enter Phone Number">\
                                        </div>\
                                    </div>\
                                    <div class="col-md-2">\
                                        <div class="form-group mb-4">\
                                           <button type="button" class="remove-btn btn btn-danger">-</button>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>');
            });

        });
    </script>
<?php include('includes/footer.php');?>