<?php
session_start();
if( !isset($_POST['sl']) && !isset($_POST['al']) ){
       header("Location:../error/error.php");
}

$_SESSION['refered_from_login_validate']=1;

error_reporting(E_ALL);
// ini_set('display_errors', 1);

require_once ('connection.php');

// echo 'helo';

// $unf=null;      //user not found
// $pnm=null;      // password not matched

$e_message=base64_encode(0);


if(isset($_POST['sl'])){   //for student form

    $email=$_POST['email'];
    $password=$_POST['pword'];

    $student_found=0;
    $student_password_matched=0;

   $query1="select s_id, email, fname, password from student";
   $result=$db->query($query1);
   $result=$result->fetchAll(PDO::FETCH_ASSOC);
   
   foreach($result as $single){
        if($email == $single['email']){
              $_SESSION['student_pword_reset_id']=$single['s_id'];
              $_SESSION['student_pword_reset_email']=$single['email'];
              $_SESSION['student_pword_reset_name']=$single['fname'];
            $student_found=1;
            if($password ==  $single['password']){
                $student_password_matched=1;
                break;
            }
        }
   }

   if($student_found == 0){
          header("Location:../index.php?unf=$e_message");
          $_SESSION['email']=$email;
          $_SESSION['password']=$password;
          $db=null;
          die();
   }else if($student_found == 1 && $student_password_matched == 0){
          $_SESSION['email']=$email; //form ma display hunalai
          $_SESSION['password']=$password;
          $_SESSION['student_forgot_password'] = 1;
          $db=null;
          header("Location:../index.php?upnm=$e_message");
   }else if($student_found == 1 && $student_password_matched == 1){
          unset($_SESSION['email'], $_SESSION['password'], $_SESSION['student_pword_reset_id'], $_SESSION['student_pword_reset_email'], $_SESSION['student_pword_reset_name']);
          $db=null;
          $_SESSION['student_id']=$single['s_id'];
       //    echo $_SESSION['student_id'];
          header('Location:user_dash.php');
   }
   unset($single);

//    echo 'hello';
}




if(isset($_POST['al'])){   //for admin form

    $email=$_POST['email2'];
    $password=$_POST['pword2'];

    $admin_found=0;
    $admin_password_matched=0;

   $query1="select a_id, email, fname, password, role from admin";
   $result=$db->query($query1);
   $result=$result->fetchAll(PDO::FETCH_ASSOC);
   
   foreach($result as $single){
        if($email == $single['email']){
            $_SESSION['admin_pword_reset_id']=$single['a_id'];
            $_SESSION['admin_pword_reset_email']=$single['email'];
            $_SESSION['admin_pword_reset_name']=$single['fname'];
            $admin_found=1;
            if($password ==  $single['password']){
                $admin_password_matched=1;
                break;
            }
        }
   }

   if($admin_found == 0){
          $_SESSION['email2']=$email;
          $_SESSION['password2']=$password;
          header("Location:../index.php?anf=$e_message&admin=1");
          $db=null;
          die();
   }else if($admin_found == 1 && $admin_password_matched == 0){
          $_SESSION['email2'] = $email;
          $_SESSION['password2'] = $password;
          $_SESSION['admin_forgot_password'] = 1;
          $db=null;
          header("Location:../index.php?apnm=$e_message&admin=1");
   }else if($admin_found == 1 && $admin_password_matched == 1){
          unset($_SESSION['email2'], $_SESSION['password2'], $_SESSION['admin_pword_reset_id'], $_SESSION['admin_pword_reset_email'], $_SESSION['admin_pword_reset_name']);
          $db=null;
          $_SESSION['admin_id']=$single['a_id']; //to verify logged in
          $_SESSION['admin_dash_email'] = $single['email'];
          $_SESSION['role'] = $single['role'];
          header('Location:../dboard/dashboard.php');
   }
   unset($single);

}

?>