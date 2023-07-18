<?php
ini_set('display_errors', 0);
error_reporting(0);
session_start();

require_once 'connection.php';
unset($_SESSION['visited_forgot_password']);



if( ($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_SESSION['student_forgot_password']))){
    
    $pword1=$_POST['changed_pword1'];
    $pword2=$_POST['changed_pword2'];
    if($pword1 == $pword2){
        $query="update student set password = '$pword1' where s_id = :sid";
        $stmt=$db->prepare($query);
        $stmt->execute([':sid'=> $_SESSION['student_pword_reset_id']]);

        
        unset($_SESSION['student_forgot_password'], $_SESSION['student_pword_reset_id']);
        header("Location:../index.php");
    }else{
        header('Location:change_password.php?error=1');
    }
}

if( ($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_SESSION['admin_forgot_password']))){
    
    $pword1=$_POST['changed_pword1'];
    $pword2=$_POST['changed_pword2'];
    if($pword1 == $pword2){
        $query="update admin set password = '$pword1' where a_id = :aid";
        $stmt=$db->prepare($query);
        $stmt->execute([':aid'=> $_SESSION['admin_pword_reset_id']]);

        
        unset($_SESSION['admin_forgot_password'], $_SESSION['admin_pword_reset_id']);
        header("Location:../index.php");
    }else{
        header('Location:change_password.php?error=1');
    }
}

if( ($_SERVER['REQUEST_METHOD']!= 'POST' && (!isset($_GET['reset'])))  && (!isset($_GET['error'])) ){ //headed from reset
    // header("Location:../index.php");
    header('Location:../error/error.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/login/book1.png"> 
    <link rel="stylesheet" href="../css/change_password.css">
    <title>LMS</title>
</head>
<body>
    <img src="../images/change_password/lock.png" id="lock_image">
    <form action="change_password.php" method="post">
        <p>Change password</p>
        <input type="password" placeholder="New password" name="changed_pword1" required><br><br>
        <input type="password" placeholder="Confirm new password" name="changed_pword2" required>
        <p>
            <?php if(isset($_GET['error'])){?>
                <?php echo "New password and confirm password didn't match"; ?><br>
            <?php }?>
        </p>
        <input type="submit" value="Change">
    </form>
</body>
</html>