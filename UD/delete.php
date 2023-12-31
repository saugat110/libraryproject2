<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
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
    }else if(isset($_POST['delete_admin'])){   //delete admin
        $query = "delete from admin where a_id  = ?";
        $stmt = $db -> prepare($query);
        $stmt -> execute([$_POST['admin_id']]);
        header('Location:../dboard/manage_admin.php');
    }else if(isset($_POST['delete_student'])){
        $query = "delete from student where s_id  = ?";
        $stmt = $db -> prepare($query);
        $stmt -> execute([$_POST['student_id']]);
        header('Location:../dboard/manage_user.php');
    }else if(isset($_POST['delete_issue_book'])){
        $query = "delete from issue_book where issue_id  = ?";
        $stmt = $db -> prepare($query);
        $stmt -> execute([$_POST['issue_id']]);
        header('Location:../dboard/issue.php');
    }