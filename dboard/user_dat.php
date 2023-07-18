<?php
ini_set('display_errors', 0);
error_reporting(0);
session_start();

if(isset($_SESSION['add_student_error'])){

    $response  = array('error' => true, 'facult' => $_SESSION['faculty']);
    echo json_encode($response);
}

if(isset($_SESSION['add_student_error'])){

    unset($_SESSION['add_student_error']);

    unset($_SESSION['fname']);
    unset($_SESSION['lname']);
    unset($_SESSION['email']);
    unset($_SESSION['faculty']);
    unset($_SESSION['address']);
    unset($_SESSION['phone']);
    unset($_SESSION['roll']);



}