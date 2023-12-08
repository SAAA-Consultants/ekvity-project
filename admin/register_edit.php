<?php
session_start();
include('config/authentication.php');
include('config/connection.php');
include('includes/header.php');?>
<body class="bg-gradient-primary">

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-center">
                <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                <div class="col-lg-7">
               
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <?php 
                        if(isset($_GET['id'])){
                            $user_id = $_GET['id'];
                            $users = "SELECT * FROM users WHERE user_id='$user_id'";
                            $users_run= mysqli_query($conn,$users);

                            if (!$users_run) {
                                die('Error in SQL query: ' . mysqli_error($conn));
                            }

                if(mysqli_num_rows($users_run) > 0)
                {
                    foreach($users_run as $user)
                    {
                        ?>

                        <form action="code.php" method="POST"  class="user">
                            <div class="form-group"> <input type="hidden" name="user_id" value="<?=$user['user_id'];?>"></div>
                           
                            
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" name="username" value="<?=$user['username'];?>" class="form-control form-control-user" id="exampleFirstName"
                                        placeholder="First Name" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="lastname" value="<?=$user['lastname'];?>" class="form-control form-control-user" id="exampleLastName"
                                        placeholder="Last Name">
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" name="password" value="<?=$user['password'];?>" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Password" required>
                                </div>
                                <div class="col-sm-6">
                                <input type="email" name="email" value="<?=$user['email'];?>" class="form-control form-control-user" id="exampleInputEmail"
                                    placeholder="Email Address" required>
                         </div>
                            </div>
                            <div class="form-group">
    <select name="role_as" class="form-control" required>
        <option value="" <?= $user['role_as'] == '' ? 'selected' : '' ?>>Select Role</option>
        <option value="0" <?= $user['role_as'] == '0' ? 'selected' : '' ?>>User</option>
        <option value="1" <?= $user['role_as'] == '1' ? 'selected' : '' ?>>Admin</option>
    </select>
</div>

<div class="form-group">
    <div class="custom-control custom-checkbox small">
        <input name="status" <?= $user['status'] == '1' ? 'checked' : '' ?> type="checkbox" class="custom-control-input" id="customCheck">
        <label class="custom-control-label" for="customCheck">Status</label>
    </div>
</div>

                            <div class="form-group">
                            <button type="submit" name="update_user" class="btn btn-primary btn-user btn-block">
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