<?php
ini_set('display_errors', 0);
error_reporting(0);
session_start();
require_once '../config/connection.php';
    if(!isset($_SESSION['admin_id'])){
        header('Location:../error/error.php');
    }

    $query = "select b_id from books";
    $stmt = $db -> prepare($query);
    $stmt -> execute([]);

    $query2 = "select auth_id from author";
    $stmt2 = $db -> prepare($query2);
    $stmt2 -> execute([]);

    $query3 = "select rack_id from rack";
    $stmt3 = $db -> prepare($query3);
    $stmt3 -> execute([]);

    $query4 = "select category_id from category";
    $stmt4 = $db -> prepare($query4);
    $stmt4 -> execute([]);

    $query5 = "select s_id from student";
    $stmt5 = $db -> prepare($query5);
    $stmt5 -> execute([]);

    $query6 = "select issue_id from issue_book";
    $stmt6 = $db -> prepare($query6);
    $stmt6 -> execute([]);

    $query7 = "select a_id from admin";
    $stmt7 = $db -> prepare($query7);
    $stmt7 -> execute([]);
    


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
    <link rel="stylesheet" href="../css/dashboard.css">
</head>


    <body>
        <?php require_once 'topbar.php'; ?>
        <?php require_once 'sidebar.php'; ?>
        <div class="content">
            <p id="title">Dashboard</p>

            <p class="row" id="p1">
                <img src="../images/dash/book.png">
                <span class="pspan">Books</span>
                <span class="value"><?php echo $stmt -> rowCount();?></span>
            </p>

            <p class="row" id="p2">
                <img src="../images/dash/author.png">
                <span class="pspan">Author</span>
                <span class="value"><?php echo $stmt2 -> rowCount();?></span>
            </p>

            <p class="row" id="p3">
                <img src="../images/dash/rack.png">
                <span class="pspan">Rack</span>
                <span class="value"><?php echo $stmt3 -> rowCount();?></span>
            </p>

            <p class="row" id="p4">
                <img src="../images/dash/categories.png">
                <span class="pspan">Categories</span>
                <span class="value"><?php echo $stmt4 -> rowCount();?></span>
            </p>

            <p class="row" id="p5">
                <img src="../images/dash/user.png">
                <span class="pspan">Users</span>
                <span class="value"><?php echo $stmt5 -> rowCount();?></span>
            </p>

            <p class="row" id="p6">
                <img src="../images/dash/issued.png">
                <span class="pspan">Issued Books</span>
                <span class="value"><?php echo $stmt6 -> rowCount();?></span>
            </p>

            <p class="row" id="p7">
                <img src="../images/dash/admins.png">
                <span class="pspan">Admins</span>
                <span class="value"><?php echo $stmt7 -> rowCount();?></span>
            </p>

        </div>
        <script src="../javascript/sidebar_active.js"></script>
    </body>

</html>