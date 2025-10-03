<?php
session_start();
include 'database.php';

$result = $conn->query("SELECT * FROM news
                        WHERE status = 'deleted'
                        ORDER BY created_at DESC");

echo "<h2>Deleted news</h2><table border='1'><tr><th>Title</th><th>Date</th></tr>";
        
while($row = $result->fetch_assoc()){
    echo "<tr>
            <td>".$row['title']."</td>
            <td>".$row['created_at']."</td>
        </tr>";
}
echo "</table>";
