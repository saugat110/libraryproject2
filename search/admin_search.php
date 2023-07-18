<?php
ini_set('display_errors', 0);
error_reporting(0);
    if(isset($_POST['input'])){
        require_once '../config/connection.php';

        $query = "select * from admin where lower(fname) like concat(:search, '%') or lower(lname) like concat(:search, '%') or lower(email) like concat(:search, '%') or lower(phone) like concat(:search, '%') or lower(address) like concat(:search, '%') or lower(role) like concat(:search, '%')";
        $stmt = $db -> prepare($query);
        $stmt -> execute([':search' => strtolower($_POST['input'])]);
        $num_rows = $stmt -> rowCount();

        $result  = $stmt ->fetchAll(PDO::FETCH_ASSOC);

        if($num_rows > 0){ ?>
            

            <table id="result_table" >
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
                            <button type="button" onclick="updateform('<?php echo $single['a_id']; ?>', '<?php echo $single['fname']; ?>', '<?php echo $single['lname']; ?>','<?php echo $single['email']; ?>','<?php echo $single['password']; ?>','<?php echo $single['phone']; ?>', '<?php echo $single['address']; ?>', '<?php echo $single['role']; ?>')" id="search_edit_button">Edit</button>
                            <form action="../UD/delete.php" method="post">
                                <input type="hidden" name="admin_id" value="<?php echo $single['a_id']; ?>">
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
