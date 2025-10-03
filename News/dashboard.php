<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Page</title>
</head>
<body>
    <hr>
    <h1>Manage News</h1>
    <ul>
        <li><a href="add_category.php">Add category.</a></li>
        <li><a href="view_categories.php">View categories.</a></li>  
        <li><a href="add_news.php">Add news.</a></li>
        <li><a href="view_news.php">View news.</a></li>
        <li><a href="deleted_news.php">Deleted news.</a></li>
        <li><a href="logout.php">Logout.</a></li>
    </ul>
    </table>
</body>
</html>