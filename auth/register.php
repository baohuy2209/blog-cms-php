<?php include '../includes/header.php'; ?>
<?php include '../config/config.php'; ?>
<?php 
  if(isset($_SESSION['username'])){
      header('location: http://localhost/php-project/clean-blog/index.php');
  }
  if(isset($_POST['submit'])){
    if($_POST['username'] == '' OR $_POST['password'] == '' OR $_POST['email'] == ''){
      echo "You must enter all field when you register new account";
    } else {
      $email = $_POST["email"];
      $password = $_POST["password"];
      $username = $_POST["username"];
      
      $checkEmailDuplicate = $conn->query("SELECT * FROM users WHERE email = '$email'");
      $checkEmailDuplicate->execute();
      if($checkEmailDuplicate->rowCount() > 0){
        echo "Email already exists"; 
      }else{
        $insert = $conn->prepare("INSERT INTO users (email, username, password) VALUES (:email, :username,:password)");
        $insert->execute([
          ':email' => $email,
          ':username' => $username, 
          ':password' => password_hash($password, PASSWORD_DEFAULT) 
        ]); 
        header("location: login.php"); 
      }
    }
  }
?>
<form method="POST" action="register.php">
    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
    </div>
    <div class="form-outline mb-4">
        <input type="" name="username" id="form2Example1" class="form-control" placeholder="Username" />

    </div>
    <!-- Password input -->
    <div class="form-outline mb-4">
        <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
    </div>
    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Register</button>
    <!-- Register buttons -->
    <div class="text-center">
        <p>Aleardy a member? <a href="login.php">Login</a></p>
    </div>
</form>



<?php include '../includes/footer.php'; ?>