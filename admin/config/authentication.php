<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['auth'])) {
    $_SESSION['message'] = "Login to Access Dashboard";
    header("Location: ./login.php");
    exit(0);
} else {
    // Code to be executed when the user is authenticated goes here
if($_SESSION['auth_role'] != "1") 
{
    $_SESSION["message"] = "You are not Authorised as ADMIN";
    header("Location: login.php");
    exit(0);
}
}
?>
