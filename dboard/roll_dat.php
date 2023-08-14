<?php

ini_set('display_errors', 0);
error_reporting(0);

require_once '../config/connection.php';

$response = array( 'roll' => false);

if(isset($_POST['input'])){
    $query = "select roll from student where roll = ? ";
    $stmt = $db-> prepare($query);
    $stmt -> execute([$_POST['input']]);

    if( ($stmt -> rowCount()) > 0  ){
        $response['roll'] = true;
    }
}



// echo 'hi';

echo json_encode($response);



// echo "hello";

?>