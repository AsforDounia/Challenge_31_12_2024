

<?php include __DIR__.'/../database/connection.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['RegisterButton'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $query = "SELECT COUNT(*) FROM User WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    if ($count == 0) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $insertQuery = "INSERT INTO User (username, fullname , password ,role_id) VALUES (:username, :fullname , :user_password , 1)";
        $stmt = $pdo->prepare($insertQuery);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':user_password', $hashedPassword);
        $stmt->execute();
        header('Location : /../views/auth/login.php');
    }
    else {
        echo "Username already exists";
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