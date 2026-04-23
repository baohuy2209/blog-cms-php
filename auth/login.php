<?php require "../includes/header.php" ?>
<?php require "../config/config.php" ?>
<?php 
    if(isset($_SESSION['username'])){
        header("Location: ".APPURL."/index.php");
    }
    if(isset($_POST['submit'])){
        if($_POST['email'] == '' OR $_POST['password'] == ''){
            echo "Please enter all fields to login"; 
        }else{
            $email = $_POST["email"];
            $password = $_POST["password"];
            $login = $conn->query("SELECT * FROM users WHERE email='$email'");
            $login->execute(); 

            $data = $login->fetch(PDO::FETCH_ASSOC); 
            if($login->rowCount() > 0){
                if(password_verify($password, $data["password"])){
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['user_id'] = $data['id']; 
                    header("location: ".APPURL."/index.php");
                }else{
                    echo "Incorrect password"; 
                }
            }else{
                echo "No user found with that email"; 
            }
        }
    }
?>
<form method="POST" action="login.php">
    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
    </div>
    <!-- Password input -->
    <div class="form-outline mb-4">
        <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
    </div>
    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>
    <!-- Register buttons -->
    <div class="text-center">
        <p>A new member? Create an acount<a href="register.php"> Register</a></p>
    </div>
</form>
<?php require "../includes/footer.php" ?>