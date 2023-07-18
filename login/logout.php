<?php  
ini_set('display_errors', 0);
error_reporting(0);
session_start();

// unset($_SESSION['admin_id'], $_SESSION['student_id']);
if(isset($_GET['logout_user'])){
    unset($_SESSION['student_id']);
    header("Location:../index.php");
}

if(isset($_GET['logout_admin'])){
    unset($_SESSION['admin_id']);
    header("Location:../index.php");
}


?>
