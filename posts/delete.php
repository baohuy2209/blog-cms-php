<?php 
    require "../config/config.php";
?>
<?php 
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $select = $conn->query("SELECT * FROM posts WHERE id = $id");
        $select->execute();
        $result = $select->fetch(PDO::FETCH_OBJ);
        if($result->user_id != $_SESSION["user_id"] AND isset($_SESSION["user_id"])){
            header("location: http://localhost/blog-cms-php/index.php");
        }
        unlink("../images/".$result->img."");
        
        $delete = $conn->prepare("DELETE FROM posts WHERE id = :id");
        $delete->execute([
            ':id' => $id
        ]);
        header("location: http://localhost/blog-cms-php/index.php");
    }else{
        header("location: http://localhost/blog-cms-php/404.php");   
    }
?>