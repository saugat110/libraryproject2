<?php  //here

require_once 'connection.php';

if (isset($_POST['search'])) {
    // echo $_POST['search'];

    $item = strtolower($_POST['search']);

    $query = "select * from person where lower(name) like concat( :search, '%')";
    $stmt = $db->prepare($query);
    $stmt->execute([':search' => $item]);
    $rows = $stmt->rowCount();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     if($rows > 0) { ?>  <!-- here -->
        <table>  
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Country</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php foreach($result as $single) {?>
                <tr>
                    <td><?php echo $single['id']; ?></td>
                    <td><?php echo $single['name']; ?></td>
                    <td><?php echo $single['age']; ?></td>
                    <td><?php echo $single['country']; ?></td>
                    <td><?php echo $single['email']; ?></td>
                    <td>
                        <form action="lamo.php">
                            <input type="hidden" value = "<?php echo $single['id'];?>" >
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php } ?>

        </table>
    <?php } else{
        echo 'not found';
    }

}
?>

