<?php
  include("connection.php");
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Sign Up</title>
  <link rel="stylesheet" href="./vendor/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/signup-style.css">
</head>
<body>
  <h2 class="logo"> </h2>
  <div class="signup-container">
    <a href="Index.php" style="text-decoration: none;" class="previous-round">&#8249;</a>
    <form id="signup-form" action="store.php" method="POST">
      <h1>SIGN-UP</h1>
      <p>Please fill in this form to create an account</p>
      <hr></hr>
      <div class="input-field">
        <label for="email">School Email</label>
        <input type="email" id="email" name="email" placeholder="Enter Email Address" autocomplete="off" required>
      </div>
      <div class="input-field">
        <label for="username">First Name</label>
        <input type="text" id="username" name="f_name" placeholder="Enter First Name" autocomplete="off" required pattern="[A-Za-z\s]+" title="Name should not contain numbers">
      </div>
      <div class="input-field">
        <label for="username">Last Name</label>
        <input type="text" id="username" name="s_name" placeholder="Enter Last Name" autocomplete="off" required pattern="[A-Za-z\s]+" title="Name should not contain numbers">
      </div>
      <div class="input-field">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password" autocomplete="off" minlength="8" required>
      </div>
      <button type="signup" class="signbtn" id="signup-button" name="signup">Sign Up</button>
    </form>
  </div>
  <script></script>
</body>
</html>
