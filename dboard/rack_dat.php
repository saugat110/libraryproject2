<?php

ini_set('display_errors', 0);
error_reporting(0);

require_once '../config/connection.php';

$response = array( 'rname' => false);

if(isset($_POST['input'])){
    $query = "select lower(Name) from rack where Name = ? ";
    $stmt = $db-> prepare($query);
    $stmt -> execute( [ strtolower($_POST['input']) ] );

    if( ($stmt -> rowCount()) > 0  ){
        $response['rname'] = true;
    }
}



// echo 'hi';

echo json_encode($response);



// echo "hello";

?>