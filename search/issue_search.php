<?php
ini_set('display_errors', 1);
error_reporting(1);
    // if(isset($_POST['input'])){
        require_once '../config/connection.php';

        $query = "select * from issue_book where lower(book) like concat(:search, '%') or lower(Student) like concat(:search, '%') or lower(Faculty) like concat(:search, '%') or Issue_date like concat(:search, '%') or Expected_return like concat(:search, '%') or lower(Status) like concat(:search, '%')";
        $stmt = $db -> prepare($query);
        $stmt -> execute([':search' => strtolower($_POST['input'])]);
        $num_rows = $stmt -> rowCount();

        $result  = $stmt ->fetchAll(PDO::FETCH_ASSOC);

        if($num_rows > 0){ ?>
            

            <table id="result_table" >
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
                        <td><?php echo $single['Status']; ?></td>
                        <td>
                            <button type="button" onclick="updateform('<?php echo $single['issue_id'];?>', '<?php echo $single['ISBN'];?>')" id="search_edit_button">Edit</button>
                            <form action="../UD/delete.php" method="post">
                                <input type="hidden" name="issue_id" value="<?php echo $single['issue_id']; ?>">
                                <input type="submit" value="Delete" name="delete_issue_book">
                            </form>
                        </td>
                    </tr>
                <?php }?>

            </table>

       <?php }else{
            echo '<p>No match Found</p>';
        }


    // }
