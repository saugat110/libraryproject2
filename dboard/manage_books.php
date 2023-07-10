<?php
session_start();
require_once '../config/connection.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location:../error/error.php');
}

$query = "select * from books order by b_id desc ";
$stmt = $db->prepare($query);
$stmt->execute();
$booK_count = $stmt -> rowCount();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query2 = "select * from author order by auth_id desc";
$stmt = $db->prepare($query2);
$stmt->execute();
$author_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query3 = "select * from category order by category_id desc";
$stmt = $db->prepare($query3);
$stmt->execute();
$category_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query4 = "select * from rack order by rack_id desc";
$stmt = $db->prepare($query4);
$stmt->execute();
$rack_result = $stmt->fetchAll(PDO::FETCH_ASSOC);


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
    <link rel="stylesheet" href="../css/manage_books.css">
    <script src="../javascript/jquery-3.6.4.min.js"></script>
</head>

<body>

    <body>
        <?php require_once 'topbar.php'; ?>
        <?php require_once 'sidebar.php'; ?>
        <div class="content">
            <div class="top_wrapper">

                <p id="book_title">Books</p>

                <button id="add_button" onclick="show_add_form()">Add Book</button>


                <input type="text" placeholder="Search..." id="book_search">
            </div>
            <div class="search_result_wrapper">
                <div class="search_result"></div> <!-- search table -->
            </div>
        <div class="default_table_wrapper">
            <?php if($booK_count > 0) {?>
            <table id="default_table"> <!-- default table-->
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>ISBN</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Rack</th>
                    <th>Copies</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($result as $single) { ?>
                    <tr>
                        <td class="image_cell"><img src="../images/books/<?php echo $single['imgname'].'?v='.uniqid(); ?>"></td>
                        <td><?php echo $single['name']; ?></td>
                        <td><?php echo $single['isbn']; ?></td>
                        <td><?php echo $single['category']; ?></td>
                        <td><?php echo $single['author']; ?></td>
                        <td><?php echo $single['rack']; ?></td>
                        <td><?php echo $single['copies']; ?></td>
                        <td>
                            <button type="button" onclick="updateform('<?php echo $single['b_id']; ?>','<?php echo $single['name']; ?>', '<?php echo $single['isbn']; ?>', '<?php echo $single['category']; ?>', '<?php echo $single['author']; ?>', '<?php echo $single['rack']; ?>', '<?php echo $single['copies']; ?>', '<?php echo $single['imgname']; ?>')" id="search_edit_button">Edit</button>
                            <form action="../UD/delete.php" method="post">
                                <input type="hidden" name="b_id" value="<?php echo $single['b_id']; ?>">
                                <input type="hidden" name="i2name" id="i2name" value="<?php echo $single['imgname'];?>"  >
                                <input type="submit" value="Delete" name="delete_book">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <?php } ?>
        </div>



        </div>


        <!-- popup parts -->

        <!-- <div class="update_form"> Update book(edit) form -->
            <!-- <p>Edit details</p>
            <form action="../UD/update.php" method="post">
                <label>Edit author name:</label>
                <input type="text" id="auth_name" name="auth_name"><br>
                <input type="hidden" name="auth_id" id="auth_id"><br>
                <input type="submit" value="Save" name="update_book_form">
                <button type="button" onclick="close_update()">Close</button>
            </form>
        </div> -->

        <div class="update_form"> <!--Update book(edit) form-->
            <p>Edit details</p>
            <p id="emessage">
                <?php if(isset($_SESSION['update_book_error'])) { ?>
                    <?php echo 'Error uploading image'; ?>
                <?php } ?>
                <!-- <?php if(isset($_SESSION['run_prequery'])) {?> <!-- to test pre_query runs only when image is ok -->
                    <?php echo 'pre query run'; ?>
                <?php } ?> -->
            </p>
            <form action="../UD/update.php" method="post" enctype="multipart/form-data">
                <label>Enter book name:</label>
                <input type="text" name="book_name" id="book_name" required  value="<?php echo (isset($_SESSION['book_name2']) )?$_SESSION['book_name2']:'';?>" ><br>

                <label for="">Enter ISBN number:</label>
                <input type="text" name="isbn" id="isbn" required value="<?php echo (isset($_SESSION['isbn2']) )?$_SESSION['isbn2']:'';?>" ><br>

                <label for="">Enter no of copies:</label>
                <input type="number" name="copies" id="copies" min="1" required  value="<?php echo (isset($_SESSION['copies2']) )?$_SESSION['copies2']:'';?>" ><br>

                <label for="">Choose Category:</label>
                <select name="category_name">
                    <?php foreach($category_result as $single) {?>
                        <option value="<?php echo $single['Name'];?>" <?php if( $single['Name'] == $_SESSION['category_name2'] ){echo "selected";} ?>  > <?php echo $single['Name']; ?> </option>
                    <?php } ?>
                </select>

                <label for="">Choose Author:</label>
                <select name="author_name">
                    <?php foreach($author_result as $single) {?>
                        <option value="<?php echo $single['Name'];?>" <?php if( $single['Name'] == $_SESSION['author_name2'] ){echo "selected";} ?>  > <?php echo $single['Name']; ?> </option>
                    <?php } ?>
                </select>

                <label for="">Choose Rack:</label>
                <select name="rack_name">
                    <?php foreach($rack_result as $single) {?>
                        <option value="<?php echo $single['Name'];?>"  <?php if( $single['Name'] == $_SESSION['rack_name2'] ){echo "selected";} ?>  > <?php echo $single['Name']; ?> </option>
                    <?php } ?>
                </select>

                <label for="">Upload image:</label>
                <input type="file" name="imgfile">

                <input type="submit" value="Save" name="update_book_form">
                <button type="button" onclick="close_update()">Close</button>

                <input type="hidden" name="b_idd" id="hido" value = "<?php if(isset($_SESSION['b_idd'])){echo $_SESSION['b_idd'];} ?>">  <!--  for updating book id -->
                <input type="hidden" name="iname" id="iname" value="<?php if(isset($_SESSION['iname'])){echo $_SESSION['iname'];} ?>">
            </form>
        </div>



        <div class="addform"> <!--add book form-->
            <p>Add Book</p>
            <p id="emessage">
                <?php if(isset($_SESSION['add_book_error'])) {?>
                    <?php echo 'Error uploading image'; ?>
                <?php } ?>
                <!-- <?php if(isset($_SESSION['run_prequery'])) {?> <!-- to test pre_query runs only when image is ok -->
                    <?php echo 'pre query run'; ?>
                <?php } ?> -->
            </p>
            <form action="../UD/add.php" method="post" enctype="multipart/form-data">
                <label>Enter book name:</label>
                <input type="text" name="book_name" required  value="<?php echo (isset($_SESSION['book_name']) )?$_SESSION['book_name']:'';?>" ><br>

                <label for="">Enter ISBN number:</label>
                <input type="text" name="isbn" required value="<?php echo (isset($_SESSION['isbn']) )?$_SESSION['isbn']:'';?>" ><br>

                <label for="">Enter no of copies:</label>
                <input type="number" name="copies" min="1" required  value="<?php echo (isset($_SESSION['copies']) )?$_SESSION['copies']:'';?>" ><br>

                <label for="">Choose Category:</label>
                <select name="category_name">
                    <?php foreach($category_result as $single) {?>
                        <option value="<?php echo $single['Name'];?>" <?php if( $single['Name'] == $_SESSION['category_name'] ){echo "selected";} ?>  > <?php echo $single['Name']; ?> </option>
                    <?php } ?>
                </select>

                <label for="">Choose Author:</label>
                <select name="author_name">
                    <?php foreach($author_result as $single) {?>
                        <option value="<?php echo $single['Name'];?>" <?php if( $single['Name'] == $_SESSION['author_name'] ){echo "selected";} ?>  > <?php echo $single['Name']; ?> </option>
                    <?php } ?>
                </select>

                <label for="">Choose Rack:</label>
                <select name="rack_name">
                    <?php foreach($rack_result as $single) {?>
                        <option value="<?php echo $single['Name'];?>"  <?php if( $single['Name'] == $_SESSION['rack_name'] ){echo "selected";} ?>  > <?php echo $single['Name']; ?> </option>
                    <?php } ?>
                </select>

                <label for="">Upload image:</label>
                <input type="file" name="imgfile">

                <input type="submit" value="Save" name="add_book_form">
                <button type="button" onclick="close_add()">Close</button>

            </form>
        </div>


        <div class="hideall"></div>  <!-- add, edit hru thichda background unclickable banauna -->


        <script src="../javascript/manage_book.js"></script>
        <script src="../javascript/sidebar_active.js"></script>

        
        <?php unset($_SESSION['run_prequery']); ?> <!-- to test if pre query runs only when image is ok -->

    </body>
</body>

</html>


<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>