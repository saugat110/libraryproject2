<div class="sidebar">
    <a href="dashboard.php" id="first_sidebar_link">Dashboard</a>
    <a href="manage_books.php">Manage Books</a>
    <a href="category.php">Category</a>
    <a href="author.php">Author</a>
    <a href="rack.php">Rack</a>
    <a href="issue.php">Issue Books</a>
    <a href="manage_user.php">Manage Users</a>
    <?php if($_SESSION['role'] == 'superadmin'){?>
        <a href="manage_admin.php" id="manage_admin">Manage Admins</a>
    <?php }?>
</div>