<?php

    require_once '../config/connection.php';

    if(isset($_POST['delete_category'])){
        // echo $_POST['category_id'];

        $query = "delete from category where category_id = :id";
        $stmt = $db -> prepare($query);
        $stmt -> execute([':id' => $_POST['category_id']]);
        header('Location:../dboard/category.php');
    
    }else if (isset($_POST['delete_author'])){
        // echo $_POST['a_id'];

        $query = "delete from author where auth_id = :id";
        $stmt = $db -> prepare($query);
        $stmt -> execute([':id' => $_POST['author_id']]);
        header('Location:../dboard/author.php');
    
    }else if (isset($_POST['delete_rack'])){
        // echo $_POST['a_id'];

        $query = "delete from rack where rack_id = :id";
        $stmt = $db -> prepare($query);
        $stmt -> execute([':id' => $_POST['rack_id']]);
        header('Location:../dboard/rack.php');

    }else if (isset($_POST['delete_book'])){
        // echo $_POST['a_id'];

        $query = "delete from books where b_id = :id";
        $stmt = $db -> prepare($query);
        $stmt -> execute([':id' => $_POST['b_id']]);
        unlink("../images/books/{$_POST['i2name']}");
        header('Location:../dboard/manage_books.php');
    }