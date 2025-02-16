<?php 
session_start();
include __DIR__.'/../layouts/header.php'; ?>
<?php include __DIR__.'/../../database/connection.php'; ?>

<h2>Admin Dashboard</h2>


<!-- Add User Button -->
<a href="./users/add.php" class="btn btn-primary mb-3">Add User</a>


<!-- TODO: Display a table of users with options to edit or delete -->
<!-- Use Bootstrap table classes -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Fullname</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        
       <?php // TODO: Fetch and display users in the table
       if(isset($_SESSION['users'])):
        $users = $_SESSION['users'];
            foreach ($users as $user) : ?>
                <tr>
                <td><?=$user['id']?></td>
                <td><?=$user['username']?></td>
                <td><?=$user['fullname']?></td>
                <?php if($user['role_id'] == 1): ?>
                    <td>Admin</td>
                <?php else: ?>
                    <td>User</td>
                <?php endif; ?>
        
            <?php // TODO: Add edit and delete links with appropriate href values?>
            <td>
                <form action="../../Controllers/UserController.php" method="post">
                    <input name="user_id" type="hidden" value="<?=$user['id'] ?>">
                    <!-- <button name="EditUser" type="submit" class="btn btn-primary" >Edit</button> -->
                    <button name="DeleteUser" type="submit" class="btn btn-danger" >Delete</button>
                </form>
                <a href='./users/edit.php' class='btn btn-warning'>Edit</a>
                
            <!-- <a href='#' class='btn btn-warning'>Edit</a> | <a href='' class='btn btn-danger'>Delete</a> -->
            </td>
            </tr>
            
            <?php endforeach; ?>

        <?php endif ?>
    </tbody>
</table>

<?php include __DIR__.'/../layouts/footer.php'; ?>
