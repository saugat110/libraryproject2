<?php

    require_once '../config/connection.php';

    if(isset($_POST['delete_category'])){
        // echo $_POST['category_id'];

        $query = "delete from category where category_id = :id";
        $stmt = $db -> prepare($query);
        $stmt -> execute([':id' => $_POST['category_id']]);
        header('Location:../dboard/category.php');
    }

    































?>