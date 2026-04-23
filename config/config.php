<?php 
    try{
        $host = "localhost"; 
        $dbname = "cleanblog";
        $user = "root"; 
        $pass = "Huy_22092005"; 
    
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass); 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
?>