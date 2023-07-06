<?php
session_start();
require_once '../config/connection.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location:../error/error.php');
}

$query = "select * from books";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query2 = "select Name from author";
$stmt = $db->prepare($query2);
$stmt->execute();
$author_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query3 = "select Name from category";
$stmt = $db->prepare($query3);
$stmt->execute();
$category_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query4 = "select Name from rack";
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

            <p id="book_title">Books</p>

            <button id="add_button" onclick="show_add_form()">Add Book</button>


            <input type="text" placeholder="Search..." id="book_search">


            <div class="search_result"></div> <!-- search table -->


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
                        <td class="image_cell"><img src="../images/books/<?php echo $single['imgname']; ?>"></td>
                        <td><?php echo $single['name']; ?></td>
                        <td><?php echo $single['isbn']; ?></td>
                        <td><?php echo $single['category']; ?></td>
                        <td><?php echo $single['author']; ?></td>
                        <td><?php echo $single['rack']; ?></td>
                        <td><?php echo $single['copies']; ?></td>
                        <td>
                            <button type="button" onclick="updateform('<?php echo $single['auth_id']; ?>', '<?php echo $single['Name']; ?>')" id="search_edit_button">Edit</button>
                            <form action="../UD/delete.php" method="post">
                                <input type="hidden" name="b_id" value="<?php echo $single['b_id']; ?>">
                                <input type="submit" value="Delete" name="delete_book">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>




        </div>


        <!-- popup parts -->

        <div class="update_form"> <!--Update book(edit) form-->
            <p>Edit details</p>
            <form action="../UD/update.php" method="post">
                <label>Edit author name:</label>
                <input type="text" id="auth_name" name="auth_name"><br>
                <input type="hidden" name="auth_id" id="auth_id"><br>
                <input type="submit" value="Save" name="update_author_form">
                <button type="button" onclick="close_update()">Close</button>
            </form>
        </div>



        <div class="addform"> <!--add book form-->
            <p>Add Book</p>
            <form action="../UD/add.php" method="post" enctype="multipart/form-data">
                <label>Enter book name:</label>
                <input type="text" name="book_name" required><br>

                <label for="">Enter ISBN number:</label>
                <input type="text" name="isbn" required><br>

                <label for="">Enter no of copies:</label>
                <input type="number" name="copies" min="1" value="10" required><br>

                <label for="">Choose Category:</label>
                <select name="category_name">
                    <?php foreach($category_result as $single) {?>
                        <option value="<?php echo $single['Name']; ?>"> <?php echo $single['Name']; ?> </option>
                    <?php } ?>
                </select>

                <label for="">Choose Author:</label>
                <select name="author_name">
                    <?php foreach($author_result as $single) {?>
                        <option value="<?php echo $single['Name']; ?>"> <?php echo $single['Name']; ?> </option>
                    <?php } ?>
                </select>

                <label for="">Choose Rack:</label>
                <select name="rack_name">
                    <?php foreach($rack_result as $single) {?>
                        <option value="<?php echo $single['Name']; ?>"> <?php echo $single['Name']; ?> </option>
                    <?php } ?>
                </select>

                <label for="">Upload image:</label>
                <input type="file" name="imgfile">

                <input type="submit" value="Save" name="add_book_form">
                <button type="button" onclick="close_add()">Close</button>
            </form>
        </div>


        <div class="hideall"></div>


        <script src="../javascript/manage_book.js"></script>
        <script src="../javascript/sidebar_active.js"></script>

    </body>
</body>

</html>