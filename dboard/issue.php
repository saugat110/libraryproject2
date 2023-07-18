<?php
ini_set('display_errors', 0);
error_reporting(0);
session_start();
require_once '../config/connection.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location:../error/error.php');
}

$query3 = "delete from issue_book where Status = 'Returned'";
$stmt3 = $db ->prepare($query3);
$stmt3 -> execute([]);

$query2 = "UPDATE issue_book SET Status = 'Not returned' WHERE Expected_return < CURDATE();";
$stmt2 = $db -> prepare($query2);
$stmt2 -> execute([]);

$query = "select * from issue_book order by issue_id desc";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// $tdy = date('Y-m-d');
$tdy = "2023-07-30";
$tdy = strtotime($tdy);



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
    <link rel="stylesheet" href="../css/issue.css">
    <script src="../javascript/jquery-3.6.4.min.js"></script>
</head>

<body>

    <body>
        <?php require_once 'topbar.php'; ?>
        <?php require_once 'sidebar.php'; ?>
        <div class="content">

            <p id="issue_title">Issue Books</p>

            <button id="add_button" onclick="show_add_form()">Issue Book</button>


            <input type="text" placeholder="Search..." id="issue_search">


            <div class="search_result"></div> <!-- search table -->


            <table id="default_table"> <!-- default table-->
                <tr>
                    <th>Issue_ID</th>
                    <th>Book</th>
                    <th>Student</th>
                    <th>Faculty</th>
                    <th>Issue_date</th>
                    <th>Expected_return </th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($result as $single) { ?>
                    <tr>
                        <td><?php echo $single['issue_id']; ?></td>
                        <td><?php echo $single['Book']; ?></td>
                        <td><?php echo $single['Student']; ?></td>
                        <td><?php echo $single['Faculty']; ?></td>
                        <td><?php echo $single['Issue_date']; ?></td>
                        <td><?php echo $single['Expected_return']; ?></td>
                        <td><?php echo $single['Status']; ?> </td>
                        <td>
                            <button type="button" onclick="updateform('<?php echo $single['issue_id'];?>', '<?php echo $single['ISBN'];?>' )" id="search_edit_button">Edit</button>
                            <form action="../UD/delete.php" method="post">
                                <input type="hidden" name="issue_id" value="<?php echo $single['issue_id']; ?>">
                                <input type="submit" value="Delete" name="delete_issue_book">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>




        </div>


        <!-- popup parts -->

        <div class="update_form"> <!--Update(edit) form-->
            <p>Edit details</p><br>   
            <form action="../UD/update.php" method="post">
                <label>Change status:</label>
                <select name="status">
                    <option value="Issued">Issued</option>
                    <option value="Returned">Returned</option>
                    <option value="Not returned">Not returned</option>
                </select>  <br>     
                <input type="hidden" name="bissue_id" id="bissue_id"><br>
                <input type="hidden" name="b_isbn" id="b_isbn">
                <input type="submit" value="Save" name="update_issue_book">
                <button type="button" onclick="close_update()">Close</button>
            </form>
        </div>



        <div class="addform"> <!--add author form-->
            <p>Issue Book</p>
            <form action="../UD/add.php" method="post">
                <p id="emessage1"></p>
                <label>Enter student roll:</label>
                <input type="number" name="sroll" id="sroll" required><br>
        
                <p id="emessage2"></p>
                <label>Enter ISBN number:</label>
                <input type="number" name="isbn" id="isbn" required><br>

                <label>Enter expected return date:</label>
                <input type="date" name="erdate" required><br>

                <label>Choose status:</label>
                <select name="status">
                    <option value="Issued">Issued</option>
                    <option value="Returned">Returned</option>
                    <option value="Not returned">Not returned</option>
                </select>
                <input type="submit" value="Save" name="issue_book_form" id="save">
                <button type="button" onclick="close_add()">Close</button>
            </form>
        </div>


        <div class="hideall"></div>


        <script src="../javascript/issue.js"></script>
        <script src="../javascript/sidebar_active.js"></script>

    </body>
</body>

</html>


