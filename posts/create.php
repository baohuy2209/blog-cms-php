<?php require "../includes/header.php" ?>
<?php require "../config/config.php" ?>
<?php 
    $selectAllCategories = $conn->query("SELECT * FROM categories");
    $selectAllCategories->execute();
    $categories = $selectAllCategories->fetchAll(PDO::FETCH_OBJ);
    if(isset($_POST['submit'])){
        $img = $_FILES['img']['name'] ?? '';
        if($_POST['title'] == '' OR $_POST['subtitle'] == '' OR $_POST['body'] == '' OR $img == ''){
            echo 'one or more inputs are empty'; 
        }else{
            $title = $_POST['title'];
            $body = $_POST['body'];
            $subtitle = $_POST['subtitle']; 
            $user_id = $_SESSION['user_id'];
            $user_name = $_SESSION['username'];
            $category_id = $_POST['category_id'];
            $dir = '../images/'.basename($img);
            $insert = $conn->prepare("INSERT INTO posts (title, subtitle, body, img, user_id, username, category_id) VALUES (:title, :subtitle, :body, :img, :user_id, :username, :category_id)");
            $insert->execute([
                ':title' => $title, 
                ':body' => $body, 
                ':subtitle' => $subtitle, 
                ':img' => $img,
                ':user_id' => $user_id, 
                ':username' => $user_name,
                ':category_id' => $category_id
            ]);
            if(move_uploaded_file($_FILES['img']['tmp_name'], $dir)){
                header("location: ".APPURL."/index.php"); 
            }
        }
    }
?>
<form method="POST" action="create.php" enctype="multipart/form-data">
    <div class="form-outline mb-4">
        <input type="text" name="title" id="form2Example1" class="form-control" placeholder="title" />
    </div>
    <div class="form-outline mb-4">
        <input type="text" name="subtitle" id="form2Example1" class="form-control" placeholder="subtitle" />
    </div>
    <div class="form-outline mb-4">
        <textarea type="text" name="body" id="form2Example1" class="form-control" placeholder="body"
            rows="8"></textarea>
    </div>
    <div class="form-outline mb-4">
        <select class="form-select" aria-label="Default select example" name="category_id">
            <?php foreach($categories as $category): ?>
            <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class=" form-outline mb-4">
        <input type="file" name="img" id="form2Example1" class="form-control" placeholder="image" />
    </div>
    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create</button>
</form>
<?php require "../includes/footer.php" ?>