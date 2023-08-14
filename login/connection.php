<?php

$dsn='mysql:host=localhost;dbname=Project3';
$username='root';
$password='';

try{
    $db=new PDO($dsn, $username, $password);
    // echo 'connected';
}catch(PDOException $e){
    echo $e->getMessage();
}

// die();
?>
