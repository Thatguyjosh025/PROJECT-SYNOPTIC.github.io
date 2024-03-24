<?php
include("login-access.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login form</title>
  <meta charset="UTF-8">
    <link rel="stylesheet" href="./vendor/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./css/loginstyle.css">
</head>
<body>
  <div class = "image-container">
  </div>
  <h2 class="logo">Inquire!</h2>
  <div class = "home-container">
    <div class="row">
    <img src="tech.png" alt="image login" class ="login-image">
      <div class = "col">
          <div class = "mb-3">
            <div class="login-container">
              <form id="login-form" action="login.php" method="POST">
              <h1>LOG-IN</h1>
               <p>Please fill in this form to login</p>
               <hr>
               <div class="input-field">
               <label for="username">Username</label>
               <input type="text" class="inpus" id="username" name="username" placeholder="Enter Username" autocomplete="off">
               </div>
               <div class="input-fieldd">
               <label for="password">Password</label>
               <input type="password" class="inppass" id="password" name="password" placeholder="Enter Password" autocomplete="off">
               </div>
               <button type="submit" class="btnlog" id="login-button" name="login">LOGIN</button>
               <div class="login-signup">
               <p>No account? <a href="signup.php" style="text-decoration: none;" class="register-link"> Sign up now</a></p>
          </div>
        </form>
      </div>
          </div>
      </div>
      </div>
      <div class = "col">
        <div class = "mb-3">
        </div>
    </div>
  </div>
 
</body>
<script src="sweetalert2.all.min.js"></script>
</html>