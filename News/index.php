<?php include 'database.php'; ?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>News</title>
</head>
<body>
    <h1>Last News</h1>
    <?php
        $result =$conn->query("SELECT * FROM news ORDER BY created_at DESC");
        while($row = $result->fetch_assoc()){
            echo "<div class='card'>";
            echo "<h2><a href='news.php?id=".$row['id']."'>".$row['title']."</a></h2>";
            echo "<p>".$row['summary']."</p>";
            if(!empty($row['image'])){
                echo "<img src='assets/uploads/".$row['image']."' width='200'>";
            }
            echo "</div>";
        }
    ?>
</body>
</html>