<?php
session_start();
include 'database.php';

if(isset($_POST['add'])){
    $name = $_POST['name'];

    $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->bind_param("s",$name);
    $stmt->execute();
    echo "Added category at successfully";
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>Add category</title>
</head>
<body>
    <h2>Add category</h2>
    <form method="post">
        <input type="text" name="name" placeholder="name category" required><br>
        <button type="submit" name="add">add</button>
    </form>
</body>
</html>