<?php 
    require "../../config/config.php";
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $delete = $conn->prepare("DELETE FROM posts WHERE id=:id");
        $delete->execute([
        ":id" => $id
        ]);
        echo "<script>window.open('http://localhost/blog-cms-php/admin-panel/posts-admins/show-posts.php','_self')</script>";
    } else {    
        header("location: http://localhost/blog-cms-php/404.php");
    }
?>