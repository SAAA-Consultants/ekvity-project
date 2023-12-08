<?php
session_start();
include('config/authentication.php');
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

                <form action="process.php" method="POST" enctype="multipart/form-data">

                    <div class="main-form mt-3 border-bottom">
                        <div class="row">
                        <input id="id" type="hidden" name="id" placeholder="Enter employeeName" class="form-control" required autocomplete="off" />
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <input id="blog_name" type="text" name="blog_name" class="form-control" required
                                        placeholder="Enter Blog Name" autocomplete="blog_name"  />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <input id="author" type="text" name="author" class="form-control" required
                                        placeholder="Enter Author Name" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <input id="blog_sub_title" type="text" name="blog_sub_title" class="form-control" required
                                        placeholder="Enter blog_sub_title" />

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <textarea id="blog_desc" name="blog_desc" class="form-control"  cols="30" rows="10"  placeholder="Enter Blog Desc"></textarea>
                                   
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    
                                    <input id="blog_image" type="file" name="blog_image" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    
                                    <input id="date" type="date" name="date" class="form-control" required
                                        placeholder="Enter date" />

                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group mb-2">

                                    <input id type="text" name="subtitle[]" class="form-control" required
                                        placeholder="Enter Subtitle" />
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group mb-4">

                                    <input type="text" name="description[]" class="form-control" required
                                        placeholder="Enter Sub-Description" />
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
                                <input name="status" type="checkbox" class="custom-control-input" id="customCheck">
                                <label class="custom-control-label" for="customCheck">Status</label>
                            </div>
                        </div>

                    </div>



                    <button type="submit" name="save_multiple_data" class="btn btn-primary mt-4">Add Blog</button>
                </form>

            </div>
        </div>
    </div>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
$(document).ready(function() {
    var maxFields = 3; // Maximum input fields allowed
    var addButton = $('.add-more-form');
    var wrapper = $('.paste-new-forms');
    var x = 1; // Initial input field count

    $(addButton).click(function(e) {
        e.preventDefault();
        if (x < maxFields) {
            x++;
            $(wrapper).append('<div class="main-form mt-3 border-bottom">\
                <div class="row">\
                    <div class="col-md-5">\
                        <div class="form-group mb-4">\
                             <input type="text" name="subtitle[]" class="form-control" required placeholder="Enter Subtitle">\
                        </div>\
                    </div>\
                    <div class="col-md-5">\
                        <div class="form-group mb-4">\
                            <input type="text" name="description[]" class="form-control" required placeholder="Enter Sub-Description">\
                        </div>\
                    </div>\
                    <div class="col-md-2">\
                        <div class="form-group mb-4">\
                           <button type="button" class="remove-btn btn btn-danger">-</button>\
                        </div>\
                    </div>\
                </div>\
            </div>');
        }
        if (x == maxFields) {
            $(addButton).attr('disabled', 'disabled');
        }
    });

    $(wrapper).on('click', '.remove-btn', function() {
        $(this).closest('.main-form').remove();
        x--;
        $(addButton).removeAttr('disabled');
    });
});
</script>
<?php include('includes/footer.php');?>