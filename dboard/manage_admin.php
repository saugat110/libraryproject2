<?php
session_start();
require_once '../config/connection.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location:../error/error.php');
}

$query = "select * from admin";
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
    <link rel="stylesheet" href="../css/manage_admin.css">
    <script src="../javascript/jquery-3.6.4.min.js"></script>
</head>

<body>

    <body>
        <?php require_once 'topbar.php'; ?>
        <?php require_once 'sidebar.php'; ?>
        <div class="content">

            <p id="admin_title">Admin</p>

            <button id="add_button" onclick="show_add_form()">Add Admin</button>


            <input type="text" placeholder="Search..." id="admin_search">


            <div class="search_result"></div> <!-- search table -->


            <table id="default_table"> <!-- default table-->
                <tr>
                    <th>Firstname</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($result as $single) { ?>
                    <tr>
                        <td><?php echo $single['fname']; ?></td>
                        <td><?php echo $single['lname']; ?></td>
                        <td><?php echo $single['email']; ?></td>
                        <td><?php echo $single['password']; ?></td>
                        <td><?php echo $single['phone']; ?></td>
                        <td><?php echo $single['address']; ?></td>
                        <td><?php echo $single['role']; ?></td>


                        <td>
                            <button type="button" onclick="updateform('<?php echo $single['a_id']; ?>', '<?php echo $single['fname']; ?>', '<?php echo $single['lname']; ?>','<?php echo $single['email']; ?>','<?php echo $single['password']; ?>','<?php echo $single['phone']; ?>', '<?php echo $single['address']; ?>','<?php echo $single['role']; ?>')" id="search_edit_button">Edit</button>
                            <form action="../UD/delete.php" method="post">
                                <input type="hidden" name="admin_id" value="<?php echo $single['a_id']; ?>">
                                <input type="submit" value="Delete" name="delete_admin">
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
                <label>Edit First name:</label>
                <input type="text" id="update_fname" name="fname" value = "<?php echo ( isset($_SESSION['fname2']) )?$_SESSION['fname2']:'';?>"><br>
                <label for="">Enter Last name:</label>
                <input type="text" id="update_lname" name="lname" value = "<?php echo ( isset($_SESSION['lname2']) )?$_SESSION['lname2']:'';?>" ><br>
                <label for="">Email:</label>
                <input type="email" name="email" id="update_email" disabled value = "<?php echo ( isset($_SESSION['email2']) )?$_SESSION['email2']:'';?>" >
                <label for="">Enter password:</label>
                <input type="text" name="password" id="update_password" value = "<?php echo ( isset($_SESSION['password2']) )?$_SESSION['password2']:'';?>">
                <label for="">Enter phone:</label>
                <input type="text" name="phone" id="update_phone" value = "<?php echo ( isset($_SESSION['phone2']) )?$_SESSION['phone2']:'';?>" >
                <label for="">Enter address:</label>
                <input type="text" name="address" id="update_address" value = "<?php echo ( isset($_SESSION['address2']) )?$_SESSION['address2']:'';?>" >
                <label for="">Select role:</label>
                <select name="update_role">
                    <option value="admin">admin</option>
                    <option value="superadmin">superadmin</option>
                </select>
                <input type="hidden" name="update_admin_id" id="update_admin_id"><br>
                <input type="submit" value="Save" name="update_admin_form">
                <button type="button" onclick="close_update()">Close</button>
            </form>
        </div>



        <div class="addform"> <!--add author form-->
            <p>Add Admin</p>
            <p id="emessage">
                <?php if(isset($_SESSION['add_admin_error'])) {?>
                    <?php echo "!!!Email already exists"; ?>
                <?php  }?>
            </p>
            <form action="../UD/add.php" method="post">
            <label>Enter First name:</label>
                <input type="text" id="fname" name="fname" value = "<?php echo ( isset($_SESSION['fname']) )?$_SESSION['fname']:'';?>" ><br>
                <label for="">Enter Last name:</label>
                <input type="text" id="lname" name="lname" value = "<?php echo( isset($_SESSION['lname']) )?$_SESSION['lname']:'';?>" ><br>
                <label for="">Enter email:</label>
                <input type="email" name="email" id="emaill" value = "<?php echo ( isset($_SESSION['email']) )?$_SESSION['email']:'';?>" >
                <label for="">Enter password:</label>
                <input type="text" name="password" id="passwordd"  value = "<?php echo( isset($_SESSION['password']) )?$_SESSION['password']:'';?>">
                <label for="">Enter phone:</label>
                <input type="text" name="phone" id="phone" value = "<?php echo( isset($_SESSION['phone']) )?$_SESSION['phone']:'';?>" >
                <label for="">Enter address:</label>
                <input type="text" name="address" id="address" value = "<?php echo( isset($_SESSION['address']) )?$_SESSION['address']:'';?>" >
                <label for="">Select role:</label>
                <select name="role">
                    <option value="admin">admin</option>
                    <option value="superadmin">superadmin</option>
                </select>
                <!-- <input type="hidden" name="update_admin_id" id="add_admin_id"><br> -->
                <input type="submit" value="Save" name="add_admin_form">
                <button type="button" onclick="close_add()">Close</button>
            </form>
        </div>


        <div class="hideall"></div>


        <script src="../javascript/manage_admin.js"></script>
        <script src="../javascript/sidebar_active.js"></script>

    </body>
</body>

</html>