<?php 
    require "../includes/navbar.php"    
?>
<?php 
    require "../config/config.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $select = $conn->prepare("SELECT * FROM posts WHERE id = :id");
        $select->execute([
            ':id' => $id
        ]);
        $post = $select->fetch(PDO::FETCH_OBJ);
    }else{
        echo "404";
    }
?>
<!-- Page Header-->
<header class="masthead" style="background-image: url('<?php echo APPURL; ?>/images/<?php echo $post->img ?>')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1><?php echo $post->title; ?></h1>
                    <h2 class="subheading"><?php echo $post->subtitle; ?></h2>
                    <span class="meta">
                        Posted by
                        <a href="#!"><?php echo $post->username; ?></a>
                        on <?php echo date('F d, Y', strtotime($post->created_at)); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Post Content-->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p><?php echo $post->body; ?></p>
                <!-- <p>
                    Placeholder text by
                    <a href="http://spaceipsum.com/">Space Ipsum</a>
                    &middot; Images by
                    <a href="https://www.flickr.com/photos/nasacommons/">NASA on The Commons</a>
                </p> -->
                <?php if ($post->username == $_SESSION["username"] AND isset($_SESSION["username"])):?>
                <a class="btn btn-warning text-center float-end"
                    href="<?php echo APPURL; ?>/posts/update.php?id=<?php echo $post->id; ?>"
                    class="btn btn-primary">Edit Post</a>
                <a class="btn btn-danger text-center"
                    href="<?php echo APPURL; ?>/posts/delete.php?id=<?php echo $post->id; ?>"
                    class="btn btn-danger">Delete Post</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</article>
<!-- Footer-->
<?php require "../includes/footer.php" ?>