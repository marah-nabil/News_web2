<?php
session_start();

include 'database.php';

if(isset($_POST['add'])){
    $title = $_POST['title'];
    $cat = $_POST['category'];
    $content = $_POST['content'];
    $uid = $_SESSION['admin'];
    $image = "";

    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){
        $image = time(). "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../assets/uploads/" . $image);
    }

    $stmt = $conn->prepare("INSERT INTO news (title, category_id, content, image, user_id) VALUES (?,?,?,?,?)");
    $stmt->bind_param("sissi",$title,$cat,$content,$image,$uid);
    $stmt->execute();
    echo "added news at sueccessfully";
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>Add New Page</title>
</head>
<body>
    <h2>Add New</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="title" required><br>
        <select name="category">
            <?php
                $cat =$conn->query("SELECT * FROM categories");
                while($c = $cat->fetch_assoc()){
                    echo "<option value='".$c['id']."'>".$c['name']."</option>";                
                }
            ?>
        </select><br>
        <textarea name="content" placeholder="Detailes" required></textarea><br>
        <input type="file" name="image"><br>

        <button type="submit" name="add">add</button>
    </form>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>