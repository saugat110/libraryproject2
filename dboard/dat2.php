<?php
ini_set('display_errors', 0);
error_reporting(0);
//for poping up update form in case of image error
session_start();
if(isset($_SESSION['update_book_error'])){
    $response  = array("error2" => true);
    echo json_encode($response);
}

if(isset($_SESSION['update_book_error'])){
    unset($_SESSION['update_book_error']);

    unset($_SESSION['book_name2']);
    unset($_SESSION['isbn2']);
    unset($_SESSION['copies2']);
    unset($_SESSION['category_name2']);
    unset($_SESSION['author_name2']);
    unset($_SESSION['rack_name2']);
    unset($_SESSION['b_idd2']);
}

?>
