<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
    // if(isset($_POST['input'])){
        require_once '../config/connection.php';


        $query = "select * from books where lower(name) like concat(:search, '%') or  isbn like concat(:search, '%') or lower(category) like concat(:search, '%') or lower(author) like concat(:search, '%') or lower(rack) like concat(:search, '%')  and copies > 0 order by b_id desc";
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
                    </tr>
                <?php } ?>

            </table>

       <?php }else{
            echo '<p style="margin-left:13px;">No match Found</p>';
        }


    // }
