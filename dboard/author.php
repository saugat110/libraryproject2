<?php
ini_set('display_errors', 0);
error_reporting(0);
session_start();
require_once '../config/connection.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location:../error/error.php');
}

$query = "select * from author order by auth_id desc";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="../css/author.css">
    <script src="../javascript/jquery-3.6.4.min.js"></script>
</head>

<body>

    <body>
        <?php require_once 'topbar.php'; ?>
        <?php require_once 'sidebar.php'; ?>
        <div class="content">

            <p id="author_title">Author</p>

            <button id="add_button" onclick="show_add_form()">Add Author</button>


            <input type="text" placeholder="Search..." id="author_search">


            <div class="search_result"></div> <!-- search table -->


            <table id="default_table"> <!-- default table-->
                <tr>
                    <th>Author_ID</th>
                    <th>Author Name</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($result as $single) { ?>
                    <tr>
                        <td><?php echo $single['auth_id']; ?></td>
                        <td><?php echo $single['Name']; ?></td>
                        <td>
                            <button type="button" onclick="updateform('<?php echo $single['auth_id']; ?>', '<?php echo $single['Name']; ?>')" id="search_edit_button">Edit</button>
                            <form action="../UD/delete.php" method="post">
                                <input type="hidden" name="author_id" value="<?php echo $single['auth_id']; ?>">
                                <input type="submit" value="Delete" name="delete_author">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>




        </div>


        <!-- popup parts -->

        <div class="update_form"> <!--Update(edit) form-->
            <p>Edit details</p>
            <form action="../UD/update.php" method="post">
                <label>Edit author name:</label>
                <input type="text" id="auth_name" name="auth_name"><br>
                <input type="hidden" name="auth_id" id="auth_id"><br>
                <input type="submit" value="Save" name="update_author_form">
                <button type="button" onclick="close_update()">Close</button>
            </form>
        </div>



        <div class="addform"> <!--add author form-->
            <p>Add Author</p>
            <form action="../UD/add.php" method="post">
                <label>Enter author name:</label>
                <input type="text" name="name"><br>
                <input type="submit" value="Save" name="add_author_form">
                <button type="button" onclick="close_add()">Close</button>
            </form>
        </div>


        <div class="hideall"></div>


        <script src="../javascript/author.js"></script>
        <script src="../javascript/sidebar_active.js"></script>

    </body>
</body>

</html>