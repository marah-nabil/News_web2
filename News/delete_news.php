<?php
session_start();
include 'database.php';

$id = intval($_GET['id']);
$conn->query("UPDATE news SET status='deleted' WHERE id=$id");
header("Location: view_news.php");
exit;
?>
