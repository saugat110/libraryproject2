<?php
    require_once '../config/connection.php';

    if(isset($_POST['update_category_form'])){  
        $id = $_POST['cat_id'];
        $name = $_POST['name'];

        // echo $id;
        // echo $name;

        $query = "update category set Name = :name where category_id = :id";
        $stmt = $db -> prepare($query);
        $stmt -> execute([':name' => $name, ':id' => $id]);
        header('Location:../dboard/category.php');
    
    }else if(isset($_POST['update_author_form'])){  
        $id = $_POST['auth_id'];
        $name = $_POST['auth_name'];

        // echo $id;
        // echo $name;

        $query = "update author set Name = :name where auth_id = :id";
        $stmt = $db -> prepare($query);
        $stmt -> execute([':name' => $name, ':id' => $id]);
        header('Location:../dboard/author.php');


    }


















?>