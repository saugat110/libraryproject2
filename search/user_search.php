<?php
ini_set('display_errors', 0);
error_reporting(0);
    if(isset($_POST['input'])){
        require_once '../config/connection.php';

        $query = "select * from student where 
            lower(fname) like concat(:search, '%')
        or lower(lname) like concat(:search, '%')
        or lower(lname) like concat(:search, '%')
        or email  like concat(:search, '%')
        or lower(lname) like concat(:search, '%')
        or phone like concat(:search, '%')
        or roll like concat(:search, '%')
        or lower(faculty) like concat(:search, '%')
        or lower(address) like concat(:search, '%')
         ";
        $stmt = $db -> prepare($query);
        $stmt -> execute([':search' => strtolower($_POST['input'])]);
        $num_rows = $stmt -> rowCount();

        $result  = $stmt ->fetchAll(PDO::FETCH_ASSOC);

        if($num_rows > 0){ ?>
            

            <table id="result_table" >
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
                                <input type="hidden" name="author_id" value="<?php echo $single['auth_id']; ?>">
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
