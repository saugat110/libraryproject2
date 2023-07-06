<?php

    if(isset($_POST['input'])){
        require_once '../config/connection.php';

        $query = "select * from author where lower(Name) like concat(:search, '%') or auth_id like concat(:search, '%')";
        $stmt = $db -> prepare($query);
        $stmt -> execute([':search' => strtolower($_POST['input'])]);
        $num_rows = $stmt -> rowCount();

        $result  = $stmt ->fetchAll(PDO::FETCH_ASSOC);

        if($num_rows > 0){ ?>
            

            <table id="result_table" >
                <tr>
                    <th>Author_ID</th>
                    <th>Author Name</th>
                    <th>Action</th>
                </tr>
                <?php foreach($result as $single) {?>
                    <tr>
                        <td><?php echo $single['auth_id']; ?></td>
                        <td><?php echo $single['Name']; ?></td>
                        <td>
                            <button type="button" onclick="updateform('<?php echo $single['auth_id'];?>', '<?php echo $single['Name'];?>')" id="search_edit_button">Edit</button>
                            <form action="../UD/delete.php" method="post">
                                <input type="hidden" name="author_id" value="<?php echo $single['auth_id'];?>">
                                <input type="submit" value="Delete" name="delete_author">
                            </form>
                        </td>
                    </tr>
                <?php }?>

            </table>

       <?php }else{
            echo '<p>No match Found</p>';
        }


    }
