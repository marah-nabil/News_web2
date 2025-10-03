<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
include 'database.php';

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM news WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
$news = $result->fetch_assoc();

if(isset($_POST['update'])){
    $title = $_POST['title'];
    $cat = $_POST['category_id'];
    $content = $_POST['content'];
    $image = $news['image'];

    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){
        $image = time(). "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../assets/uploads/" . $image);
    }

    $stmt = $conn->prepare("UPDATE news SET title=?, category_id=?, content=?, image=? WHERE id=?");
    $stmt->bind_param("sissi",$title,$cat,$content,$image, $id);
    $stmt->execute();
    header("Location: view_news.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>Edit New Page</title>
</head>
<body>
    <h2>Edit New</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="title" value="<?php echo $news['title']; ?>" required><br>
        <select name="category_id" required>
            <?php
                $cat =$conn->query("SELECT * FROM categories");
                while($c = $cat->fetch_assoc()){
                    $selected = ($c['id'] == $news['category_id']) ? "selected" : "";
                    echo "<option value='".$c['id']."' $selected>".$c['name']."</option>";                
                }
            ?>
        </select><br>
        <textarea name="content" required><?php echo $news['content']; ?></textarea><br>
        <input type="file" name="image"><br>
                <?php if(!empty($news['image'])): ?>
                    <img src="assets/uploads/<?php echo $news['image']; ?>" width="150"><br>
                    <?php endif; ?>
        <button type="submit" name="update">Edit</button>
    </form>
</body>
</html>