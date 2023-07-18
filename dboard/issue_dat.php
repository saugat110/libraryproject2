<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../config/connection.php';

$response = array( 'roll' => false, 'isbn' => false);

if(isset($_POST['input1'])){
    $query = "select roll from student where roll = ? ";
    $stmt = $db-> prepare($query);
    $stmt -> execute([$_POST['input1']]);

    if( ($stmt -> rowCount()) > 0  ){
        $response['roll'] = true;
    }
}

if(isset($_POST['input2'])){
    $query2 = "select isbn from books where isbn = ? ";
    $stmt2 = $db-> prepare($query2);
    $stmt2 -> execute([$_POST['input2']]);
    // $stmt2 -> execute([]);


    if( ($stmt2 -> rowCount()) > 0  ){
        $response['isbn'] = true;
    }
}








// echo 'hi';

echo json_encode($response);



// echo "hello";

