<?php

ini_set('display_errors', 0);
error_reporting(0);

require_once '../config/connection.php';

$response = array( 'inum' => false);

if(isset($_POST['input'])){
    $query = "select isbn from books where isbn = ? ";
    $stmt = $db-> prepare($query);
    $stmt -> execute( [ strtolower($_POST['input']) ] );

    if( ($stmt -> rowCount()) > 0  ){
        $response['inum'] = true;
    }
}



// echo 'hi';

echo json_encode($response);



// echo "hello";

?>