<?php
ini_set('display_errors', 0);
error_reporting(0);
session_start();


if(isset($_SESSION['add_admin_error'])){
    $response = array('error' => true, 'role' => $_SESSION['role']);
    echo json_encode(($response));
}

if(isset($_SESSION['add_admin_error'])){
    unset($_SESSION['add_admin_error']);
    unset($_SESSION['fname']);
    unset($_SESSION['lname']);
    unset($_SESSION['email']);
    unset($_SESSION['phone']);
    unset($_SESSION['password']);
    unset($_SESSION['address']);
    unset($_SESSION['role']);
}


