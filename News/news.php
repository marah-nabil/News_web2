<?php include 'database.php'; ?>
<?php
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM news WHERE id=$id");
    $news = $result->fetch_assoc();
    ?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title><?php echo $news['title']; ?></title>
</head>
<body>
    <h1><?php echo $news['title']; ?></h1>
    <p><?php echo $news['content']; ?></p>
    <?php if(!empty($news['image'])): ?>
        <img src="asset/uploads/<?php echo $news['image']; ?>" width="400">
    <?php  endif;  ?>
</body>
</html>