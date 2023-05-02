<?php
    session_start();
    if(!isset($_SESSION['admin_id'])){
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
    <link rel="stylesheet" href="../css/category.css">
</head>

<body>

    <body>
        <?php require_once 'topbar.php'; ?>
        <?php require_once 'sidebar.php'; ?>
        <div class="content">
            <p>THIS IS category</p>

        </div>
    </body>
</body>

</html>