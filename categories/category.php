<?php require "../includes/header.php" ?>
<?php require "../config/config.php"?>
<?php 
    $selectAllCategories = $conn->query("SELECT * FROM categories");
    $selectAllCategories->execute();
    $categories = $selectAllCategories->fetchAll(PDO::FETCH_OBJ); 
    if(isset($_GET["category_id"])){
        $category_id = $_GET["category_id"];
        $selectAll = $conn->query("SELECT * FROM posts WHERE category_id = '$category_id'");
        $selectAll->execute();
        $posts = $selectAll->fetchAll(PDO::FETCH_OBJ); 
    }else{
        header("location: ".APPURL."/index.php");
    }
?>
<div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-7">
        <!-- Post preview-->
        <?php foreach ( $posts as $post ): ?>
        <div class="post-preview">
            <a href="<?php echo APPURL; ?>/posts/post.php?id=<?php echo $post->id; ?>">
                <h2 class="post-title"><?php echo $post->title; ?></h2>
                <h3 class="post-subtitle"><?php echo $post->subtitle; ?></h3>
            </a>
            <p class="post-meta">
                Posted by
                <a href="#!"><?php echo $post->username; ?></a>
                on <?php echo date('F d, Y', strtotime($post->created_at)); ?>
            </p>
        </div>
        <!-- Divider-->
        <hr class="my-4" />
        <?php endforeach; ?>
    </div>
</div>
<div class="row gx-4 gx-lg-5 justify-content-center">
    <h3>Categories</h3>
    <br />
    <br />
    <br />
    <?php foreach($categories as $category ): ?>
    <div class="col-md-6">
        <a href="<?php echo APPURL; ?>/categories/category.php?category_id=<?php echo $category->id; ?>">
            <div class="alert alert-dark bg-dark text-center text-white" role="alert">
                <?php echo $category->name; ?>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
</div>

<?php require "../includes/footer.php" ?>