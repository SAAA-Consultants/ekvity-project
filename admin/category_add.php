<?php
session_start();
include('config/authentication.php');
include('config/connection.php');
include('includes/header.php');?>


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
                    <form action="category_process.php" method="POST" enctype="multipart/form-data">

<div class="main-form mt-3 border-bottom">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-4">
                <input type="text" name="name" class="form-control" required
                    placeholder="Enter categories">
            </div>
        </div>
       </div>
</div>

<div class="paste-new-forms"></div>
<div class="form-group mt-4">
                        <div class="custom-control custom-checkbox small">
                            <input name="status" type="checkbox"
                                class="custom-control-input" id="customCheck">
                            <label class="custom-control-label" for="customCheck">Status</label>
                        </div>
                    </div>


<button type="submit" name="category_btn" class="btn btn-primary mt-4">Add Blog</button>
</form>



                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
                    


<?php include('includes/footer.php');?>