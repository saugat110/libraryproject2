<?php
ini_set('display_errors', 0);
error_reporting(0);

session_start();
require_once '../config/connection.php';

if (!isset($_SESSION['student_id'])) {
    header('Location:../error/error.php');
}

$query = "select Book, Expected_return, ISBN from issue_book where roll = ?";
$stmt = $db -> prepare($query);
$stmt -> execute([$_SESSION['user_dash_rolll']]);
$result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="../css/user_borrowed.css">
    <script src="../javascript/jquery-3.6.4.min.js"></script>
</head>

<body>

    <body>
        <?php require_once 'topbar2.php'; ?>
        <?php require_once 'sidebar2.php'; ?>
        <div class="content">

            <p id="borrow_title">Borrowed Book</p>
            <?php if($stmt -> rowCount() > 0){ ?>

            <table id="result_table">
                <tr>
                    <th>Image</th>
                    <th>Book Name</th>
                    <th>Return Date</th>
                </tr>
                <?php foreach($result as $single) { ?>
                    <tr>
                        <?php $query2 = "select imgname from books where isbn = ?"; ?>
                        <?php $stmt2 = $db ->prepare($query2); ?>
                        <?php $stmt2 -> execute([$single['ISBN']]); ?>
                        <?php $result2 = $stmt2 -> fetch(PDO::FETCH_ASSOC); ?>
                        <td class="image_cell"><img src="../images/books/<?php echo $result2['imgname'].'?v='.uniqid(); ?>" alt=""></td>
                        <td><?php echo $single['Book']; ?></td>
                        <td><?php echo $single['Expected_return']; ?></td>
                    </tr>
                <?php } ?>
            </table>

        <?php } ?>


        </div>



        


        <!-- <script src="../javascript/user_book_search.js"></script> -->
        <script src="../javascript/sidebar_active.js"></script>

    </body>
</body>

</html>