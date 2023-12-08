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
    <h6 class="m-0 font-weight-bold text-primary text-left">Ekvity User</h6>
    <a href="user.php" class="btn btn-info ml-auto">Back</a>
</div>
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-center">
                
                <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                <div class="col-lg-7">
               
                    <div class="p-5">
                    

                        <form action="code.php" method="POST"  class="user">
                            
                        <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" name="username"  class="form-control form-control-user" id="exampleFirstName"
                                        placeholder="First Name" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="lastname"  class="form-control form-control-user" id="exampleLastName"
                                        placeholder="Last Name">
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" name="password"  class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Password" required>
                                </div>
                                <div class="col-sm-6">
                                <input type="email" name="email" 
                                 class="form-control form-control-user" id="exampleInputEmail"
                                    placeholder="Email Address" required>
                         </div>
                            </div>
                            <div class="form-group">
    <select name="role_as" class="form-control" required>
        <option value="">Select Role</option>
        <option value="0">User</option>
        <option value="1">Admin</option>
    </select>
</div>

<div class="form-group">
    <div class="custom-control custom-checkbox small">
        <input name="status"  type="checkbox" class="custom-control-input" id="customCheck">
        <label class="custom-control-label" for="customCheck">Status</label>
    </div>
</div>

                            <div class="form-group">
                            <button type="submit" name="add_user" class="btn btn-primary btn-user btn-block">
                                Add User
                            </button>
                                </div>
                           
                            <hr>
                            
                        </form>



                        
                        </div>
                </div>
            </div>
        </div>
    </div>

</div>

                        <?php include('includes/footer.php');?>