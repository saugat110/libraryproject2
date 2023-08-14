<?php
ini_set('display_errors', 0);
error_reporting(0);
session_start();
require_once '../config/connection.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location:../error/error.php');
}

$query = "select * from student order by s_id desc";
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
    <link rel="stylesheet" href="../css/manage_user.css">
    <script src="../javascript/jquery-3.6.4.min.js"></script>
</head>

<body>

    <body>
        <?php require_once 'topbar.php'; ?>
        <?php require_once 'sidebar.php'; ?>
        <div class="content">

            <p id="student_title">Students</p>

            <button id="add_button" onclick="show_add_form()">Add Student</button>


            <input type="text" placeholder="Search..." id="student_search">


            <div class="search_result"></div> <!-- search table -->

            <?php if($rcount > 0){?>

            <table id="default_table"> <!-- default table-->
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Faculty</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Roll</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($result as $single) { ?>
                    <tr>
                        <td><?php echo $single['fname']; ?></td>
                        <td><?php echo $single['lname']; ?></td>
                        <td><?php echo $single['faculty']; ?></td>
                        <td><?php echo $single['email']; ?></td>
                        <td><?php echo $single['phone']; ?></td>
                        <td><?php echo $single['address']; ?></td>
                        <td><?php echo $single['roll']; ?></td>
                        <td> <!-- edit button removed --> 
                            <form action="../UD/delete.php" method="post">
                                <input type="hidden" name="student_id" value="<?php echo $single['s_id']; ?>">
                                <input type="submit" value="Delete" name="delete_student">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>

            <?php } ?>


        </div>


        <!-- popup parts -->


        <div class="addform"> <!--add author form-->
            <p>Add Student</p>
            <p id="emessage">
                <?php if(isset($_SESSION['add_student_error'])) { ?>
                    <?php echo "!!!User already exists"; ?>
                <?php } ?>
            </p>
            <form action="../UD/add.php" method="post">
                <label>Enter First name:</label>
                <input type="text" name="fname" required value="<?php echo (isset($_SESSION['fname']))?$_SESSION['fname']:'';?>" ><br>
                <label>Enter Last name:</label>
                <input type="text" name="lname" required value="<?php echo (isset($_SESSION['lname']))?$_SESSION['lname']:'';?>" ><br>
                <label>Choose faculty:</label>
                <select name="facult" >
                    <option value="BCA">BCA</option>
                    <option value="BBS">BBS</option>
                    <option value="BSW">BSW</option>
                </select>
                <label>Enter email:</label>
                <input type="email" name="email" required value="<?php echo (isset($_SESSION['email']))?$_SESSION['email']:'';?>" ><br>
                <label>Enter phone:</label>
                <input type="text" name="phone" required  value="<?php echo (isset($_SESSION['phone']))?$_SESSION['phone']:'';?>" ><br>
                <label>Enter address:</label>
                <input type="text" name="address" required  value="<?php echo (isset($_SESSION['address']))?$_SESSION['address']:'';?>" ><br>
                <label>Enter roll number:</label>
                <input type="number" name="roll" required value="<?php echo (isset($_SESSION['roll']))?$_SESSION['roll']:'';?>" min="0" ><br>
                
                <input type="submit" value="Save" name="add_student_form">
                <button type="button" onclick="close_add()">Close</button>
            </form>
        </div>


        <div class="hideall"></div>


        <script src="../javascript/manage_user.js"></script>
        <script src="../javascript/sidebar_active.js"></script>

    </body>
</body>

</html>