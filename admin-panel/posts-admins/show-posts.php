<?php require "../layouts/header.php" ?>
<?php require "../../config/config.php"?>
<?php 
  if(!isset($_SESSION["adminname"])){
    header("location: ".ADMIN_URL."/admins/login-admins.php");
  }
  $select = $conn->prepare("SELECT p.id as id ,p.title as title, c.name as category, p.username as username, p.status as status FROM posts as p JOIN categories as c ON p.category_id = c.id");
  $select->execute();
  $allPosts = $select->fetchAll(PDO::FETCH_OBJ);
?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline">Posts</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">User</th>
                            <th scope="col">Status</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($allPosts as $post) :?>
                        <tr>
                            <th scope="row"><?php echo $post->id; ?></th>
                            <td><?php echo $post->title; ?></td>
                            <td><?php echo $post->category; ?></td>
                            <td><?php echo $post->username; ?></td>
                            <td><?php if($post->status == 1): ?>
                                <a href="status-posts.php?id=<?php echo $post->id; ?>&status=0">
                                    <span class="badge badge-success">Active</span>
                                </a>
                                <?php else: ?>
                                <a href="status-posts.php?id=<?php echo $post->id; ?>&status=1">
                                    <span class="badge badge-danger">Inactive</span>
                                </a>
                                <?php endif; ?>
                            </td>
                            <td><a href="<?php echo ADMIN_URL; ?>/posts-admins/delete-posts.php?id=<?php echo $post->id; ?>"
                                    class="btn btn-danger text-center ">Delete</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require "../layouts/footer.php" ?>