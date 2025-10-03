<?php
session_start();
include 'database.php';

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id,password FROM users WHERE email = ?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result =$stmt->get_result();

    if($result && $result->num_rows >0){
        $user = $result->fetch_assoc();
        $storedHash = $user['password'];
        $userId = $user['id'];

        if(password_verify($password,$storedHash)){
            $_SESSION['admin'] = $userId;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password not correct";
        }
        /*
        if($storedHash === md5($password)){
            $newHash = password_hash($password, PASSWORD_DEFAULT);
            $up = $conn->prepare("UPDATE users SET password = ? WHERE id =?");
            $up->bind_param("si",$newHash,$userId);
            $up->execute();

            $_SESSION['admin'] = $userId;
            header("Location: dashboard.php");
            exit;
        }
            */
    } else {
            $error = "Username not correct";
    }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login to go Dashboard</h2>
    <form method="post">
       Email:  <input type="email" name="email" placeholder="Enter Email" required><br>
        Password: <input type="password" name="password" placeholder="password" required><br>
        <button type="submit" name="login">Login</button>
    </form>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>