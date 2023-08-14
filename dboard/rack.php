<?php
ini_set('display_errors', 0);
error_reporting(0);
session_start();
require_once '../config/connection.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location:../error/error.php');
}

$query = "select * from rack order by rack_id desc";
$stmt = $db->prepare($query);
$stmt->execute();
$rcount = $stmt -> rowCount();
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
    <link rel="stylesheet" href="../css/rack.css">
    <script src="../javascript/jquery-3.6.4.min.js"></script>
</head>

<body>

    <body>
        <?php require_once 'topbar.php'; ?>
        <?php require_once 'sidebar.php'; ?>
        <div class="content">

            <p id="rack_title">Rack</p>

            <button id="add_button" onclick="show_add_form()">Add Rack</button>


            <input type="text" placeholder="Search..." id="rack_search">


            <div class="search_result"></div> <!-- search table -->

            <?php if($rcount > 0) {?>

            <table id="default_table"> <!-- default table-->
                <tr>
                    <th>Rack_ID</th>
                    <th>Rack Name</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($result as $single) { ?>
                    <tr>
                        <td><?php echo $single['rack_id']; ?></td>
                        <td><?php echo $single['Name']; ?></td>
                        <td>
                            <button type="button" onclick="updateform('<?php echo $single['rack_id']; ?>', '<?php echo $single['Name']; ?>')" id="search_edit_button">Edit</button>
                            <form action="../UD/delete.php" method="post">
                                <input type="hidden" name="rack_id" value="<?php echo $single['rack_id']; ?>">
                                <input type="submit" value="Delete" name="delete_rack">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>


            <?php } ?>

        </div>


        <!-- popup parts -->

        <div class="update_form"> <!--Update(edit) form-->
            <p>Edit details</p>
            <form action="../UD/update.php" method="post">
                <label>Edit rack name:</label>
                <input type="text" id="rack_name" name="rack_name"><br>
                <input type="hidden" name="rack_id" id="rack_id"><br>
                <input type="submit" value="Save" name="update_rack_form">
                <button type="button" onclick="close_update()">Close</button>
            </form>
        </div>



        <div class="addform"> <!--add author form-->
            <p>Add Rack</p>
            <span id="emessage"></span>
            <form action="../UD/add.php" method="post">
                <label>Enter rack name:</label>
                <input type="text" name="name" id="rname"><br>
                <input type="submit" value="Save" name="add_rack_form" id="save">
                <button type="button" onclick="close_add()">Close</button>
            </form>
        </div>


        <div class="hideall"></div>


        <script src="../javascript/rack.js"></script>
        <script src="../javascript/sidebar_active.js"></script>

    </body>
</body>

</html>