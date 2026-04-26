<?php require "includes/header.php" ?>
<?php require "config/config.php"?>
<?php 
  if(isset($_POST['search'])) {
    if($_POST['search'] !== '') {
      $search = $_POST['search'];
      $select = $conn->prepare("SELECT * FROM posts WHERE title LIKE '%$search%' AND status=1");
      $select->execute();
      $posts = $select->fetchAll(PDO::FETCH_OBJ);
      if($select->rowCount() == 0) {
        echo "<div class='alert alert-danger bg-danger text-white text-center'>No results found for '$search'.</div>";
      } else {
        echo "<div class='alert alert-success bg-success text-white text-center'>Search results for '$search':</div>";
      }      
    }else{
      echo "<div class='alert alert-danger bg-danger text-white text-center'>Please enter a search term.</div>";
    }
  }
?>
<div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-7">
        <!-- Post preview-->
        <?php if(count($posts) > 0): ?>
        <div>
            Number of results: <?php echo count($posts); ?>
        </div>
        <?php else: ?>
        <p class="text-center">No posts found.</p>
        <?php endif; ?>
        <?php foreach ( $posts as $post ): ?> <div class="post-preview">
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
<?php require "includes/footer.php" ?>