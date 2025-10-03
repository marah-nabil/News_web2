<?php
include 'database.php';

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name,email,password) VALUES (?,?,?)");
    $stmt->bind_param("sss",$name,$email,$password);
    
    if($stmt->execute()){
        //echo "Create User Register successfully";
        header("Location: login.php");
        exit;
    }else{
        echo "Error: ".$stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>Register Page</title>
</head>
<body>
    <h2>Register User</h2>
    <form method="post">
       Name:  <input type="text" name="name" placeholder="name" required><br>
       Email:  <input type="email" name="email" placeholder="Enter Email" required><br>
        Password:  <input type="password" name="password" placeholder="password" required><br>
        <button type="submit" name="register">register</button>
    </form>
</body>
</html>