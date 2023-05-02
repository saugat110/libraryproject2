<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'connection.php';

if(isset($_SESSION['admin_id'])){

    $query="select fname from admin where a_id = :aid";
    $stmt=$db->prepare($query);
    $stmt->execute([':aid'=>$_SESSION['admin_id']]);
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    echo 'Hi '. $result['fname'];

    $db=null;
}else{
    header('Location:index.php');
}
// echo 'hi';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="logout.php?logout_admin=1">Logout</a>
</body>
</html>

