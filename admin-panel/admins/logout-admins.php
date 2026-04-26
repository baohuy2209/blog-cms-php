<?php 
    session_start();
    session_destroy();
    header("location: http://localhost/blog-cms-php/admin-panel/index.php");
?>