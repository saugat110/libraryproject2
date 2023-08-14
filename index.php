<?php
ini_set('display_errors', 0);
error_reporting(0);
session_start();
$e_message = base64_encode(0);

if(isset($_SESSION['admin_id'])){
    header('Location:dboard/dashboard.php');
}
if(isset($_SESSION['student_id'])){
    header('Location:user/user_search_book.php');
}


//for student credential error
$user_not_found=(isset($_GET['unf']))?$_GET['unf']:'';
$user_password_not_matched=(isset($_GET['upnm']))?$_GET['upnm']:'';

//for admin credential error
$admin_not_found=(isset($_GET['anf']))?$_GET['anf']:'';
$admin_password_not_matched=(isset($_GET['apnm']))?$_GET['apnm']:'';

?>


<!DOCTYPE html>
<head>
    <title>LMS</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="icon" href="images/login/book1.png"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aboreto&family=Montserrat:wght@200&display=swap" rel="stylesheet">
</head>
<body>
    <div class="background"></div>
    <div class="login">

        <div class="image">
            <img src="images/login/book2.png"/>
        </div>

        <div class="library">
            <h1><span class="header">Mini Library</span><br> Management System</h1>
        </div>

        <p id="form_title"><span id="span1">Student</span> <span id="span2"> Login</span></p>


        <form action="login/login_validate.php" id="f1" method="post">    <!-- student login -->

            <p style="min-height:19.2px;max-height:19.2px;" id="error_message1"> <!-- p tag for error message student -->
                <?php if(!empty($user_not_found)) { ?>
                    <?php echo "User not registered"; ?>
                    <?php $user_not_found=null; ?>
                <?php } ?>

                <?php if(!empty($user_password_not_matched)) { ?>
                    <?php echo "Incorrect Password"; ?>
                    <!-- <?php $user_password_not_matched=null; ?> -->
                <?php } ?>
            </p>

            <input type="email" placeholder="Enter email user form" name="email" id="email" value="<?php echo $_SESSION['email'];?>"><br>
            <input type="password" placeholder="Enter password" name="pword" id="pword" value="<?php echo $_SESSION['password'];?>"><br>
            <?php unset($_SESSION['email'], $_SESSION['password']); ?> <!-- refresh grda udosh vnera -->

            <input type="hidden" name="sl" value="1"> <!--identify login -->
            <input type="checkbox" name="c1" id="c1">
            <label for="c1">Show password</label><br>
                
            <a href="login/forgot_password.php" id="forgot_password1">
            <?php if(isset($_GET['upnm'])) {?>
                <?php echo 'Forgot password?'; ?>
            <?php }?>
            </a>

            <input type="submit" value="Login">
            <input type="reset" id="reset1">
        </form>

        <form action="login/login_validate.php" id="f2" method="post">     <!-- admin login -->

            <p style="min-height:19.2px;max-height:19.2px;" id="error_message2"> <!-- p tag for error message admin-->
                <?php if(!empty($admin_not_found)) { ?>
                    <?php echo "User not registered"; ?>
                    <?php $admin_not_found=null; ?>
                <?php } ?>

                <?php if(!empty($admin_password_not_matched)) { ?>
                    <?php echo "Incorrect Password"; ?>
                    <?php $admin_password_not_matched=null; ?>
                <?php } ?>
            </p>

            <input type="email" placeholder="Enter email admin form" name="email2" id="email2" value="<?php echo $_SESSION['email2'];?>"><br>
            <input type="password" placeholder="Enter password" name="pword2" id="pword2" value="<?php echo $_SESSION['password2'];?>"><br>
            <?php unset($_SESSION['email2'], $_SESSION['password2']); ?> <!-- refresh grda udosh vnera -->

            <input type="hidden" name="al" value="1"> <!--identify login -->
            <input type="checkbox" name="c2" id="c2">
            <label for="c2">Show password</label><br>

            <a href="login/forgot_password.php" id="forgot_password2">
            <?php if(isset($_GET['apnm'])) {?>
                <?php echo 'Forgot password?'; ?>
            <?php }?>
            </a>

            <input type="submit" value="Login">
            <input type="reset" >
        </form>

    </div>
    <button id="button1" onclick="toggleforms()">Admin Login</button>
    <!-- <p id="tester">hello</p> -->
    <script src="login/login2.js"></script>
</body>


</html>