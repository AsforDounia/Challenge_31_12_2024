<?php include __DIR__.'/../../layouts/header.php'; ?>

<h2>Add User</h2>

<form method="post" action="../../../Controllers/UserController.php">
    <!-- TODO: Add input fields for name and email -->
    <div class="form-group">
        <label for="fullname">fullname:</label>
        <input type="text" class="form-control" name="fullname" id="fullname" required>
    </div>
    <div class="form-group">
        <label for="username">username:</label>
        <input type="username" class="form-control" name="username" id="username" required>
    </div>
    <div class="form-group">
        <label for="password">username:</label>
        <input type="password" class="form-control" name="password" id="password" required>
    </div>

    <div class="form-group">
       <select name="role_id" id="role">
        <option default>select role</option>
        <option value="1">admin</option>
        <option value="2">user</option>
       </select>
    </div>

    <!-- TODO: Add submit button -->
    <button name="adminAddUser" type="submit" class="btn btn-primary">Add Employee</button>
</form>

<?php include __DIR__.'/../../layouts/footer.php'; ?>
