<?php
ini_set('display_errors', 0);
error_reporting(0);

session_start();
require_once '../config/connection.php';

if (!isset($_SESSION['student_id'])) {
    header('Location:../error/error.php');
}

$query = "select * from student where s_id = ?";
$stmt = $db -> prepare($query);
$stmt -> execute([$_SESSION['student_id']]);
$result = $stmt -> fetch(PDO::FETCH_ASSOC);

// print_r($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS</title>
    <link rel="icon" href="../images/login/book1.png">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/edit_user_info.css">
    <script src="../javascript/jquery-3.6.4.min.js"></script>
</head>

<body>

    <body>
        <?php require_once 'topbar2.php'; ?>
        <?php require_once 'sidebar2.php'; ?>
        <div class="content">

            <p id="edit_title">Edit Info</p>

            <form action="../UD/update.php" method ="post">
                <label>Enter Firstname:</label>
                <input type="text" name="fname" value="<?php echo $result['fname'];?>"><br>

                <label>Enter Lastname:</label>
                <input type="text" name="lname" value="<?php echo $result['lname'];?>"><br>

                <label>Enter email:</label>
                <input type="email" name="email" value="<?php echo $result['email'];?>"><br>

                <label>Enter phone:</label>
                <input type="text" name="phone" value="<?php echo $result['phone'];?>"><br>

                <label>Roll:</label>
                <input type="text" name="roll" value="<?php echo $result['roll'];?>" disabled><br>
                <input type="hidden" name="hidden_roll" value="<?php echo $result['roll'];?>">

                <label>Choose faculty:</label>
                <select name="faculty"><br>
                    <option value="BCA" <?php echo ($result['faculty'] == 'BCA')?'selected':''; ?> >BCA</option>
                    <option value="BSW"  <?php echo ($result['faculty'] == 'BSW')?'selected':''; ?> >BSW</option>
                    <option value="BBS"  <?php echo ($result['faculty'] == 'BBS')?'selected':''; ?> >BBS</option>
                </select><br>

                <label>Enter address:</label>
                <input type="text" name="address" value="<?php echo $result['address'];?>"><br>


                <label>Enter password:</label>
                <input type="text" name="password" value="<?php echo $result['password'];?>"><br>

                <input type="hidden" name="sid" value="<?php echo $_SESSION['student_id']; ?> ">
                <input type="submit" value="Update" name="update_user_info">
            </form>


        </div> 


        <?php if(isset($_SESSION['user_updated'])) {?>
            <p id="message">Details updated</p>
        <?php } ?>


        <!-- <script src="../javascript/user_book_search.js"></script> -->
        <script src="../javascript/sidebar_active.js"></script>

    </body>
</body>

</html>

<?php

unset($_SESSION['user_updated']);

?>