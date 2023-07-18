<?php
//add book garesi image upload grda error ayo (add_book_error) session set hunxa ani
//  back to manage_books.php ma janxa ani add form afai khulxa
//for popping up add book form in case of image error
ini_set('display_errors', 0);
error_reporting(0);
session_start();

if(isset($_SESSION['add_book_error'])){
    $response  = array("error" => true);
    echo json_encode($response);
}

// if(isset($_SESSION['update_book_error'])){
//     $response  = array("error2" => true);
//     echo json_encode($response);
// }

if(isset($_SESSION['add_book_error'])){
    unset($_SESSION['add_book_error']);

    unset($_SESSION['book_name']);
    unset($_SESSION['isbn']);
    unset($_SESSION['copies']);
    unset($_SESSION['category_name']);
    unset($_SESSION['author_name']);
    unset($_SESSION['rack_name']);
}

// if(isset($_SESSION['update_book_error'])){
//     unset($_SESSION['update_book_error']);

//     unset($_SESSION['book_name2']);
//     unset($_SESSION['isbn2']);
//     unset($_SESSION['copies2']);
//     unset($_SESSION['category_name2']);
//     unset($_SESSION['author_name2']);
//     unset($_SESSION['rack_name2']);
//     unset($_SESSION['b_idd2']);
// }


?>