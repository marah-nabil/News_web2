<?php

$host = "localhost";
$user = "root";
$pass = "";
$db_name = "news_db";

$conn = new mysqli($host,$user,$pass,$db_name);

if($conn->connect_error){
    die("DB connection in Failed :".$conn->connect_error);
}

$conn->set_charset("utf8");

?>