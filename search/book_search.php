<?php
ini_set('display_errors', 0);
error_reporting(0);
    if(isset($_POST['input'])){
        require_once '../config/connection.php';

        $query = "select * from books where lower(name) like concat(:search, '%') or  isbn like concat(:search, '%') or lower(category) like concat(:search, '%') or lower(author) like concat(:search, '%') or lower(rack) like concat(:search, '%') order by b_id desc";
        $stmt = $db -> prepare($query);
        $stmt -> execute([':search' => strtolower($_POST['input'])]);
        $num_rows = $stmt -> rowCount();

        $result  = $stmt ->fetchAll(PDO::FETCH_ASSOC);

        if($num_rows > 0){ ?>
            

            <table id="result_table" >  <!-- default table ra result table ko code same id class sabai -->
                
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
                            <button type="button" onclick="updateform('<?php echo $single['b_id']; ?>','<?php echo $single['name']; ?>', '<?php echo $single['isbn']; ?>', '<?php echo $single['category']; ?>', '<?php echo $single['author']; ?>', '<?php echo $single['rack']; ?>', '<?php echo $single['copies']; ?>')" id="search_edit_button">Edit</button>
                            <form action="../UD/delete.php" method="post">
                                <input type="hidden" name="b_id" value="<?php echo $single['b_id']; ?>">
                                <input type="submit" value="Delete" name="delete_book">
                            </form>
                        </td>
                    </tr>
                <?php } ?>

            </table>

       <?php }else{
            echo '<p style="margin-left:13px;">No match Found</p>';
        }


    }
