<?php

ini_set('display_errors', 0);
error_reporting(0);

require_once '../config/connection.php';

$response = array( 'aname' => false);

if(isset($_POST['input'])){
    $query = "select lower(Name) from author where Name = ? ";
    $stmt = $db-> prepare($query);
    $stmt -> execute( [ strtolower($_POST['input']) ] );

    if( ($stmt -> rowCount()) > 0  ){
        $response['aname'] = true;
    }
}



// echo 'hi';

echo json_encode($response);



// echo "hello";

?>