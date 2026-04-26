<?php 
    require "../includes/navbar.php"    
?>
<?php 
    require "../config/config.php";
    if(!isset($_SESSION["user_id"])){
        header("location: ".APPURL."/index.php");
    }
    if(isset($_GET["id"]) AND isset($_POST["submitComment"])){
        $comment = $_POST["comment"];
        $post_id = $_GET["id"];
        $user_id = $_SESSION["user_id"];
        $insert = $conn->prepare("INSERT INTO comments (comment, post_id, user_id) VALUES (:comment, :post_id, :user_id)");
        $insert->execute([
            ':comment' => $comment,
            ':post_id' => $post_id,
            ':user_id' => $user_id
        ]);
    }
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $select = $conn->prepare("SELECT * FROM posts WHERE id = :id");
        $select->execute([
            ':id' => $id
        ]);
        $post = $select->fetch(PDO::FETCH_OBJ);
        $selectAllComment = $conn->prepare("SELECT c.*, u.username FROM comments as c JOIN users as u ON c.user_id = u.id WHERE c.post_id = :post_id");
        $selectAllComment->execute([
            ':post_id' => $post->id
        ]);
        $comments = $selectAllComment->fetchAll(PDO::FETCH_OBJ);
    }else{
        header("location: ".APPURL."/404.php");
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
<section>
    <div class="container my-5 py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-8">
                <h3 class="mb-5">Comments</h3>
                <div class="card">
                    <div class="card-body">
                        <?php if (count($comments) > 0) : ?>
                        <?php foreach($comments as $comment): ?>
                        <div class="d-flex flex-start align-items-center">
                            <div>
                                <h6 class="fw-bold text-primary">
                                    <?php echo $comment->username; ?><h8 class="p-3 text-black">
                                        (<?php echo date('F d, Y', strtotime($comment->created_at)); ?>)</h8>
                                </h6>
                            </div>
                        </div>
                        <p class="mt-3 mb-4 pb-2">
                            <?php echo $comment->comment; ?>
                        </p>
                        <hr class="my-4" />
                        <?php endforeach; ?>
                        <?php else: ?>
                        <p class="text-center">No comment yet. Be the first one to comment.</p>
                        <?php endif; ?>
                    </div>
                    <form method="POST" action="post.php?id=<?php echo $post->id; ?>">
                        <div class="card-footer py-3 border-0" style="background-color: #f8f9fa">
                            <div class="d-flex flex-start w-100">
                                <div class="form-outline w-100">
                                    <textarea class="form-control" id="comment" placeholder="write message" rows="4"
                                        name="comment"></textarea>
                                </div>
                            </div>
                            <div class="float-end mt-2 pt-1">
                                <button type="submit" name="submitComment" class="btn btn-primary btn-sm mb-3">
                                    Post comment
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Footer-->
<?php require "../includes/footer.php" ?>