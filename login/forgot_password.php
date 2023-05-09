<?php
session_start();

error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);


if( (isset($_SESSION['refered_from_login_validate']) || isset($_SESSION['refered_from_reset_password']))){
    require_once '../vendor/mail.php';
    require_once '../login/connection.php';
    // unset($_SESSION['visited_forgot_password']);

    if( isset($_SESSION['student_forgot_password']) && (!isset($_GET['cnm'])) && (!isset($_SESSION['visited_forgot_password']))){ //for student
        $reset_code=substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz'), 0, 5);

        $query="update student set pcode = '$reset_code' where s_id = :sid";
        $stmt=$db->prepare($query);
        $stmt->execute([':sid'=> $_SESSION['student_pword_reset_id']]);



        reset_mail($_SESSION['student_pword_reset_email'], $_SESSION['student_pword_reset_name'], $reset_code);

        unset($_SESSION['student_pword_reset_email'], $_SESSION['student_pword_reset_name']);
        // $db=null;
        $_SESSION['visited_forgot_password']=true;

    }

     
    
    
    
    
    if ( (isset($_SESSION['admin_forgot_password'])) && (!isset($_GET['cnm'])) && (!isset($_SESSION['visited_forgot_password']) ) ){ //for admin
        $reset_code=substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz'), 0, 5);

        $query="update admin set pcode = '$reset_code' where a_id = :aid";
        $stmt=$db->prepare($query);
        $stmt->execute([':aid'=> $_SESSION['admin_pword_reset_id']]);



        reset_mail($_SESSION['admin_pword_reset_email'], $_SESSION['admin_pword_reset_name'], $reset_code);

        unset($_SESSION['admin_pword_reset_email'], $_SESSION['admin_pword_reset_name']);
        // $db=null;

        $_SESSION['visited_forgot_password']=true;
    }
    // unset($_SESSION['refered_from_login_validate'], $_SESSION['refered_from_reset_password']);
    // if(isset($_GET['cnm'])){
    //     echo 'code not matched';
    // }
}else{
    // header('Location:index.php');
    // header("Location:../error/error.php");
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/login/book1.png"> 
    <link rel="stylesheet" href="../css/forgot_password.css">
    <title>LMS</title>
</head>
<body>
    <div class="container">
        <img src="../images/forgot_password/i1.png" id="i1">
        <img src="../images/forgot_password/cloud.png" id="i2">
        <img src="../images/forgot_password/cloud.png" id="i3">
        <form action="reset_password.php" method="post">
            <p>Forgot</p>
            <p>Your password ?</p>
            <p id="e_message" >
                <?php if(isset($_GET['cnm'])) {?>
                    <?php echo 'Code error'; ?>
                <?php } ?>
            </p>
            <input type="text" placeholder="Enter verification code" name="v_code"><br>
            <input type="submit" value="Reset Password">
        </form>
    </div>
</body>
</html>