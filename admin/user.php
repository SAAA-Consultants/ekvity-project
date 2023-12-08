<?php
session_start();
include('config/authentication.php');
include('config/connection.php');
include('includes/header.php');


?>

        

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 style="color: rgba(34, 54, 108, 1); font-family:Tenor Sans-Regular, Helvetica;font-weight: 400;font-size:2.5rem; " class="h3 mb-2 text-center mb-4">
                        <img src="./img/heading-1.svg" alt=""> User <img src="./img/heading-2.svg" alt="">
                    </h1>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <!-- side button css -->
                        <!-- <div style="display: flex; justify-content: space-between; align-items: center;" class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Blog Tables</h6>
                     <button class="btn btn-success">+ Add Blog</button> -->
                        <!--  -->
                    <div class="card-header py-3 d-flex align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary text-left">Ekvity User</h6>
    <a href="add_user.php" class="btn btn-primary ml-auto">+ Add User</a>
</div>

                        <div class="card-body">
                        <?php include('message.php');?>
                            <div class="table-responsive">
                                <table class="table " id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-light">
                                            <th>Sr No</th>
                                            <th>FirstNmae</th>
                                            <th>LastName</th>
                                            <th>Email</th>
                                            <th>Role as</th>
                                            <th>Date</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           <th>Sr No</th>
                                            <th>FirstNmae</th>
                                            <th>LastName</th>
                                            <th>Email</th>
                                            <th>Role as</th>
                                            <th>Date</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                        $query ="SELECT * FROM users";
                                        $query_run = mysqli_query($conn,$query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $row)
                                            {
                                                ?>
                                                 <tr>
                                            <td><?= $row['user_id']; ?></td>
                                            <td><?= $row['username']; ?></td>
                                            <td><?= $row['lastname']; ?></td>
                                            <td><?= $row['email']; ?></td>
                                            <td>
                                                <?php
                                                if($row['role_as'] =='1'){
                                                    echo 'Admin';
                                                } elseif($row['role_as'] == '0') 
                                                {
                                                    echo 'User';

                                                }
                                                     
                                                 ?>
                                            </td>
                                            <td><?= $row['created_at']; ?></td>
                                            <td> <a class="btn btn-success btn-circle btn-sm" href="register_edit.php?id=<?=$row['user_id'];?>">  <i class="fas fa-edit"></i></a></td>
                                            <td>  
                                                <form action="code.php" method="POST">
                                                    <button type="submit" name="user_delete" value="<?=$row['user_id'];?>" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button>

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