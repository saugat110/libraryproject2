<?php
    require_once '../config/connection.php';

    if(isset($_POST['add_category_form'])){ //category
        
        $filters = array(
            'name' => FILTER_SANITIZE_SPECIAL_CHARS
        );

        $insert = filter_input_array(INPUT_POST, $filters);

        $query = "insert into category (Name) values (?)";
        $stmt = $db -> prepare($query);
        $stmt -> execute([$insert['name']]);
        header("Location:../dboard/category.php");
    
    }else if(isset($_POST['add_author_form'])){ //category
        
        $filters = array(
            'name' => FILTER_SANITIZE_SPECIAL_CHARS
        );

        $insert = filter_input_array(INPUT_POST, $filters);

        $query = "insert into author (Name) values (?)";
        $stmt = $db -> prepare($query);
        $stmt -> execute([$insert['name']]);
        header("Location:../dboard/author.php");
    
    }else if(isset($_POST['add_rack_form'])){ //category
        
        $filters = array(
            'name' => FILTER_SANITIZE_SPECIAL_CHARS
        );

        $insert = filter_input_array(INPUT_POST, $filters);

        $query = "insert into rack (Name) values (?)";
        $stmt = $db -> prepare($query);
        $stmt -> execute([$insert['name']]);
        header("Location:../dboard/rack.php");

    }