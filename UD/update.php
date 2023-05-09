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
    }





















?>