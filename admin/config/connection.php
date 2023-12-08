<?php

$server = "localhost";
$username = "root";
$password = ""; // If your MySQL server has a password, provide it here
$database = "blog_ekvity";

$conn =  mysqli_connect($server, $username, $password, $database);

// Check connection
if(!$conn)
 {
    header("Location: ../errror/dberror.php");
    die();

    
}


?>
