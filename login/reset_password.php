<?php
session_start();

$_SESSION['refered_from_reset_password']=1;

//this page acts as mediator between forgot_password and change_password

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once 'connection.php';

    $reset_code_from_user=$_POST['v_code'];

    // echo 'helo';


    if(isset($_SESSION['student_forgot_password'])){
        $query="select pcode from student where s_id = :sid";
        $stmt=$db->prepare($query);
        $stmt->execute([':sid'=>$_SESSION['student_pword_reset_id']]);
        $result=$stmt->fetch(PDO::FETCH_ASSOC);

        // echo $reset_code_from_user;
        // echo $result['pcode'];
        
        if(trim($reset_code_from_user) ==  $result['pcode']){ //trim white space on both side
            echo 'matched';
            unset($_SESSION['refered_from_login_validate'], $_SESSION['refered_from_reset_password']);
            header('Location:change_password.php?reset=1');
        }else{
            echo 'not matched';
            header('Location:forgot_password.php?cnm=1');
        }
    }


    if(isset($_SESSION['admin_forgot_password'])){
        $query="select pcode from admin where a_id = :aid";
        $stmt=$db->prepare($query);
        $stmt->execute([':aid'=>$_SESSION['admin_pword_reset_id']]);
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        
        if($reset_code_from_user == $result['pcode']){
            // unset($_SESSION['admin_forgot_password']);
            unset($_SESSION['refered_from_login_validate'], $_SESSION['refered_from_reset_password']);
            header('Location:change_password.php?reset=1');
        }else{
            header('Location:forgot_password.php?cnm=1');
        }
    }


}else{
    // header('Location:index.php');
    // header('Location:../error/error.php');
}
?>
