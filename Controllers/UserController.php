<?php
include __DIR__.'/../database/connection.php';

session_start();

if(isset($_POST['adminAddUser'])){
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if(!empty($username) && !empty($password) && !empty($fullname) && !empty($role_id)){
        $query = "INSERT INTO user (username, fullname, password, role_id) VALUES (:username , :fullname, :password, :role_id)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role_id', $role_id);
        $stmt->execute();
        $query = "SELECT * FROM user";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['users'] = $users;
        header('Location: ../views/admin/dashboard.php');
        exit;
    }
}

if(isset($_POST['DeleteUser'])){
    $id = $_POST['user_id'];
    $query = "DELETE FROM user WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();


    $query = "SELECT * FROM user";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['users'] = $users;
    header('Location: ../views/admin/dashboard.php');
}


if(isset($_POST['updateUser'])){
    $id = $_POST['user_id'];
    $username = $_POST['username'];

}

?>