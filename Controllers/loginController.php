

<?php include __DIR__.'/../database/connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['loginSubmit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM User WHERE username = :user_name";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_name', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        $role_id = $user['role_id'];
        if ($role_id == 1) {
            $query = "SELECT * FROM user";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['users'] = $users;
            header('Location: ../views/admin/dashboard.php');
            exit;
        } elseif ($role_id == 2) {
            header('Location: userdashboard.php');
            exit;
        }
    } else {
        echo 'Invalid username or password';
    }
}




// -- Role Table
// CREATE TABLE Role (
//     id INT PRIMARY KEY AUTO_INCREMENT,
//     name VARCHAR(50) NOT NULL UNIQUE
// );

// -- Sample Roles
// INSERT INTO Role (name) VALUES
// ('Admin'),
// ('User');


// -- User Table
// CREATE TABLE User (
//     id INT PRIMARY KEY AUTO_INCREMENT,
//     username VARCHAR(50) NOT NULL UNIQUE,
//     fullname VARCHAR(50) NOT NULL,
//     password VARCHAR(255) NOT NULL, -- appropriate length for hashed passwords
//     role_id INT NOT NULL,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     FOREIGN KEY (role_id) REFERENCES Role(id) ON DELETE CASCADE
// );

?>