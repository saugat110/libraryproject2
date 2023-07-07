<?php
//add book garesi image upload grda error ayo (add_book_error) session set hunxa ani
//  back to manage_books.php ma janxa ani add form afai khulxa

session_start();

if(isset($_SESSION['add_book_error'])){
    $response  = array("error" => true);
    echo json_encode($response);
}

if(isset($_SESSION['add_book_error'])){
    unset($_SESSION['add_book_error']);
    unset($_SESSION['book_name']);
    unset($_SESSION['isbn']);
    unset($_SESSION['copies']);
    unset($_SESSION['category_name']);
    unset($_SESSION['author_name']);
    unset($_SESSION['rack_name']);
}


?>