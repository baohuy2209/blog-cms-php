<?php 
    session_start();
    session_unset(); 
    session_destroy(); 
    header("location: http://localhost/php-project/clean-blog/auth/login.php");
?>