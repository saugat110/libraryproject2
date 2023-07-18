<?php
ini_set('display_errors', 0);
error_reporting(0);
session_start();
require_once '../config/connection.php';

if (!isset($_SESSION['student_id'])) {
    header('Location:../error/error.php');
}


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
    <link rel="stylesheet" href="../css/user.css">
    <script src="../javascript/jquery-3.6.4.min.js"></script>
</head>

<body>

    <body>
        <?php require_once 'topbar2.php'; ?>
        <?php require_once 'sidebar2.php'; ?>
        <div class="content">

            <p id="user_title">Search Book</p>

            <input type="text" placeholder="Search..." id="book_search">


            <div class="search_result"></div> <!-- search table -->


            <!-- <table id="default_table">  -->
                
            </table>




        </div>


        <!-- popup parts -->

        


        <script src="../javascript/user_book_search.js"></script>
        <script src="../javascript/sidebar_active.js"></script>
        
    </body>
</body>

</html>