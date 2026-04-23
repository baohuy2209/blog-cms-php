<?php require "../includes/header.php" ?>
<?php require "../config/config.php" ?>
<?php 
    if(isset($_POST['submit'])){
        if($_POST['title'] == '' OR $_POST['subtitle'] == '' OR $_POST['body'] == '' OR $_POST['img'] == ''){
            echo 'one or more inputs are empty'; 
            echo $_POST['title'] .' '. $_POST['subtitle'] .' '.$_POST['body'].' '.$_FILES['img']['name'];
        }else{
            $title = $_POST['title'];
            $body = $_POST['body'];
            $subtitle = $_POST['subtitle']; 
            $img = $_FILES['img']['name']; 
            $user_id = $_SESSION['user_id'];
            $user_name = $_SESSION['username'];
            $dir = '../images/'.basename($img);
            $insert = $conn->prepare("INSERT INTO posts (title, subtitle, body, img, user_id, username) VALUES (:title, :subtitle, :body, :img, :user_id, :username)");
            $insert->execute([
                ':title' => $title, 
                ':body' => $body, 
                ':subtitle' => $subtitle, 
                ':img' => $img,
                ':user_id' => $user_id, 
                ':username' => $user_name
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
        <input type="file" name="img" id="form2Example1" class="form-control" placeholder="image" />
    </div>
    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create</button>
</form>
<?php require "../includes/footer.php" ?>