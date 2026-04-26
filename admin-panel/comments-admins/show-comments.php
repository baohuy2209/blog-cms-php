<?php require "../layouts/header.php" ?>
<?php require "../../config/config.php"?>
<?php 
  if(!isset($_SESSION["adminname"])){
    header("location: ".ADMIN_URL."/admins/login-admins.php");
  }
  $select = $conn->prepare("SELECT * FROM comments ");
  $select->execute();
  $allComments = $select->fetchAll(PDO::FETCH_OBJ);
?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline">Comments</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Comment</th>
                            <th scope="col">User Id</th>
                            <th scope="col">Post Id</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($allComments as $comment) :?>
                        <tr>
                            <th scope="row"><?php echo $comment->id; ?></th>
                            <td><?php echo $comment->comment; ?></td>
                            <td><?php echo $comment->user_id; ?></td>
                            <td><?php echo $comment->post_id; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require "../layouts/footer.php" ?>