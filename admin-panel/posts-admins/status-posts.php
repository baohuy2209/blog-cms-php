<?php 
    require "../../config/config.php";
?>
<?php 
    if(isset($_GET["status"]) !== "" && isset($_GET["status"]) && $_GET["id"] !== "" && isset($_GET["id"])) {
        $status = $_GET["status"];
        $id = $_GET["id"];
        $update = $conn->prepare("UPDATE posts SET status=:status WHERE id=:id");
        $update->bindParam(":status", $status);
        $update->bindParam(":id", $id);
        $update->execute();
        header("location: http://localhost/blog-cms-php/admin-panel/posts-admins/show-posts.php");        
    }else{
        header("location: http://localhost/blog-cms-php/404.php");
    }
?>