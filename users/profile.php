<?php 
    require "../includes/header.php";    
    require "../config/config.php";

    $post = null;

    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $select = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $select->execute([':id' => $id]);
        $user = $select->fetch(PDO::FETCH_ASSOC);
        if($user['id'] != $_SESSION["user_id"] AND isset($_SESSION["user_id"])){
            header("location: ".APPURL."/index.php");
            exit();
        }
        if(isset($_POST["submit"])){
            if($_POST["email"] == '' OR $_POST["username"] == ''){
                echo "<script>alert('Please fill in all fields');</script>";         
            } else {
                $update = $conn->prepare("UPDATE users SET email = :email, username = :username WHERE id = :id");
                $update->execute([":email" => $_POST["email"], ":username" => $_POST["username"], ":id" => $id]);
                header("location: ".APPURL."/users/profile.php?id=".$id); // ✅ sửa syntax
                exit();
            }
        }
    } else {
        echo "404";
    }
?>

<?php if($user): ?>
<form method="POST" action="profile.php?id=<?php echo $user['id']; ?>" enctype="multipart/form-data">
    <div class="form-outline mb-4">
        <input type="text" name="email" class="form-control" placeholder="Email"
            value="<?php echo $user['email']; ?>" />
    </div>
    <div class="form-outline mb-4">
        <input type="text" name="username" class="form-control" placeholder="Username"
            value="<?php echo $user['username']; ?>" />
    </div>
    <button type="submit" name="submit" class="btn btn-primary mb-4">Update</button>
</form>
<?php else: ?>
<p>Post not found.</p>
<?php endif; ?>

<?php require "../includes/footer.php" ?>