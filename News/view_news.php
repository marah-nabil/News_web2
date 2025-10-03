<?php
session_start();
include 'database.php';

$result = $conn->query("SELECT news.*,categories.name as cat_name
                        FROM news
                        LEFT JOIN categories ON news.category_id = categories.id
                        WHERE status = 'active'
                        ORDER BY created_at DESC");

echo "<h2>News</h2><table border='1'><tr><th>Title</th><th>Category</th><th>Date</th><th>Details</th></tr>";
        
while($row = $result->fetch_assoc()){
    echo "<tr>
            <td>".$row['title']."</td>
            <td>".$row['cat_name']."</td>
            <td>".$row['created_at']."</td>
            <td>
                <a href='edit_news.php?id=".$row['id']."'>Edit</a> |
                <a href='delete_news.php?id=".$row['id']."'>delete</a> |                
            </td>
        </tr>";
}
echo "</table>";
