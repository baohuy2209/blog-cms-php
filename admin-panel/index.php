<?php require "layouts/header.php" ?>
<?php require "../config/config.php" ?>
<?php 
    if(!isset($_SESSION["adminname"])){
        header("location: ".ADMIN_URL."/admins/login-admins.php");
    }
    $numAllPosts = $conn->query("SELECT COUNT(id) as num FROM posts");
    $numPosts = $numAllPosts->fetch(PDO::FETCH_OBJ);
    $numCategory = $conn->query("SELECT COUNT(id) as num FROM categories");
    $numCategories = $numCategory->fetch(PDO::FETCH_OBJ);
    $numAdmins = $conn->query("SELECT COUNT(id) as num FROM admins");
    $numAdmins = $numAdmins->fetch(PDO::FETCH_OBJ);
    // $numReplies = $conn->query("SELECT COUNT(id) as num FROM replies");
    // $numReplies = $numReplies->fetch(PDO::FETCH_OBJ);
?>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Posts</h5>
                <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
                <p class="card-text">Number of posts: <?php echo $numPosts->num; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Categories</h5>
                <p class="card-text">Number of categories: <?php echo $numCategories->num; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Admins</h5>
                <p class="card-text">number of admins: <?php echo $numAdmins->num; ?></p>
            </div>
        </div>
    </div>
</div>
<?php require "layouts/footer.php" ?>