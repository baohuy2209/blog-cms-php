<?php 
    require "../includes/header.php";    
    require "../config/config.php";

    $post = null;

    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $select = $conn->prepare("SELECT * FROM posts WHERE id = :id");
        $select->execute([':id' => $id]); // ✅ thêm dấu :
        $post = $select->fetch(PDO::FETCH_ASSOC);
        if($post['user_id'] != $_SESSION["user_id"] AND isset($_SESSION["user_id"])){
            header("location: ".APPURL."/index.php");
            exit();
        }
        if(isset($_POST["submit"])){
            $img = $_FILES["img"]["name"];
            if($img != ""){
                unlink("../images/".$post["img"]."");
                $dir = '../images/'.basename($img);
                move_uploaded_file($_FILES["img"]["tmp_name"], $dir);
                $update = $conn->prepare("UPDATE posts SET title = :title, subtitle = :subtitle, body = :body, img = :img WHERE id = :id");
                $update->execute([
                    ":title" => $_POST["title"],
                    ":subtitle" => $_POST["subtitle"],
                    ":body" => $_POST["body"],
                    ":img" => $img,
                    ":id" => $id,
                ]);
            } else {
                $update = $conn->prepare("UPDATE posts SET title = :title, subtitle = :subtitle, body = :body WHERE id = :id");
                $update->execute([
                    ":title" => $_POST["title"],
                    ":subtitle" => $_POST["subtitle"],
                    ":body" => $_POST["body"],
                    ":id" => $id,
                ]);
            }
            header("location: ".APPURL."/posts/post.php?id=".$id); // ✅ sửa syntax
            exit();
        }
    } else {
        header("location: ".APPURL."/404.php");
    }
?>

<?php if($post): ?>
<form method="POST" action="update.php?id=<?php echo $post['id']; ?>" enctype="multipart/form-data">
    <div class="form-outline mb-4">
        <input type="text" name="title" class="form-control" placeholder="title"
            value="<?php echo $post['title']; ?>" />
    </div>
    <div class="form-outline mb-4">
        <input type="text" name="subtitle" class="form-control" placeholder="subtitle"
            value="<?php echo $post['subtitle']; ?>" />
    </div>
    <div class="form-outline mb-4">
        <textarea name="body" class="form-control" placeholder="body" rows="8"><?php echo $post['body']; ?></textarea>
    </div>
    <div class="form-outline mb-4">
        <input type="file" name="img" class="form-control" />
    </div>
    <button type="submit" name="submit" class="btn btn-primary mb-4">Update</button>
</form>
<?php else: ?>
<p>Post not found.</p>
<?php endif; ?>

<?php require "../includes/footer.php" ?>