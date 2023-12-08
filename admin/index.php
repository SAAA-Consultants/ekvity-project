<?php
session_start();
include('config/authentication.php'); 
include('config/connection.php');
include('includes/header.php');
?>
 
 
 <!-- Begin Page Content -->
 <div class="container-fluid">
<?php include('message.php');  ?>
<!-- Page Heading -->
<!-- <h1 class="h3 mb-0 text-gray-800 text-center"> Welcom to our Ekvity Dashboard</h1> -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    
   
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
</div>
<div class="admin-header mt-4 mb-4 bg-gradient-light" style="max-width: 900px; margin: 0 auto; padding-top: 30px; border: solid 1px;">
    <div class="row">
        <div class="col-md-6 pl-4 ">
            <h1>
                <b class="mb-5">Welcome back to Our Ekvity Dashboard</b> <br>
                <!-- <small class="describe" >You have earned 54% more than last month, which is a great thing.</small> <br> -->
                <a href="blog_form.php"><button style="border: none; padding: 0px 16px; height: 36px; font-size: 18px; background-color: #22366c; color: #fff;">Add blog</button></a>
                <a href="carrier.php"><button style="border: none; padding: 0px 16px; height: 36px; font-size: 18px; background-color: #22366c; color: #fff;">Add Carrier</button></a>
                
            </h1>
        </div>
        <div class="col-md-6">
            <img class="img-fluid" src="img/Layer 136 1.png" alt="">
        </div>
    </div>
</div>


<!-- Content Row -->
<div class="row m-4 p-4">

<?php
// Assuming you have a database connection
$conn = new mysqli("localhost", "root", "", "blog_ekvity");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$stmtTotalBlogs = $conn->prepare("SELECT COUNT(*) as totalBlogs FROM blog WHERE status=1");
$stmtTotalBlogs->execute();
$resultTotalBlogs = $stmtTotalBlogs->get_result();
$rowTotalBlogs = $resultTotalBlogs->fetch_assoc();
$totalBlogs = $rowTotalBlogs['totalBlogs'];
?>

<!-- Now, update the content in your "Blog" card -->
<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Blog</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalBlogs; ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$queryTotaljob = "SELECT COUNT(*) as totaljob FROM job_requirements";
$resultTotaljob = mysqli_query($conn, $queryTotaljob);
$rowTotaljob = mysqli_fetch_assoc($resultTotaljob);
$totaljob = $rowTotaljob['totaljob'];
?>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Careers </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totaljob; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas  fa-desktop fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <!-- <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <?php
$queryTotalRequests = "SELECT COUNT(*) as totalRequests FROM contact_form";
$resultTotalRequests = mysqli_query($conn, $queryTotalRequests);
$rowTotalRequests = mysqli_fetch_assoc($resultTotalRequests);
$totalRequests = $rowTotalRequests['totalRequests'];
?>

<!-- Now, update the content in your "Pending Requests" card -->
<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Pending Requests</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalRequests; ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Content Row -->
<?php include('includes/footer.php');?>