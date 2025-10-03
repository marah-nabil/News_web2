<?php
session_start();
include 'database.php';

$result = $conn->query("SELECT * FROM categories ORDER BY created_at DESC");

echo "<h2>Categories</h2><table border='1'><tr><th>ID</th><th>Name</th></tr>";
        
while($row = $result->fetch_assoc()){
    echo "<tr><td>".$row['id']."</td><td>".$row['name']."</td></tr>";
}
echo "</table>";
