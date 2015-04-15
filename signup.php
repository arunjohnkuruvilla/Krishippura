<?php 
  require("./workspace/config.php");
  require("./workspace/initialize_database.php");
  $error = "";
  if(isset($_POST['signup'])){
    if(isset($_POST['nameLogin'])
      AND isset($_POST['usernameLogin']) 
      AND isset($_POST['passwordLogin']) 
      AND isset($_POST['repasswordLogin'])
      AND isset($_POST['emailLogin'])
      AND $_POST['nameLogin'] != ""
      AND $_POST['usernameLogin'] != "" 
      AND $_POST['passwordLogin'] != ""
      AND $_POST['repasswordLogin'] != ""
      AND $_POST['emailLogin'] != "") {
      $name = $_POST['nameLogin'];
      $username = $_POST['usernameLogin'];
      $password = $_POST['passwordLogin'];
      $repassword = $_POST['repasswordLogin'];
      $email = $_POST['emailLogin'];
      $user_check = $mysqli->query("INSERT INTO `user` (`user_id`, `user_name`, `user_real_name`, `user_password`, `user_creation_time`, `user_email`, `user_status`) VALUES (NULL, '$username', '$name', '$password', CURRENT_TIMESTAMP, '$email', '0');");
      if($user_check) {
        $error = "You have signed up successfully. Please wait while another editor approves you.";
      }
      else {
        $error = "Signup failed. Please try again";
      }
    }
    else {
      $error = "Please enter all fields";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <base href="/" >
  <meta charset="utf-8">
  <title>Signup</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/custom.css">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="">

</head>
<body>

  <!-- Navigation Bar -->
  <?php include("./includes/layout/navbar.php") ?>

  <div class="container" style="padding-top:5rem">
    <div class="row">
      <form action="signup.php", method="POST" name="signUpForm" id="signUpForm">
         <div class="row">
          <div class="eight columns">
            <input class="u-full-width" type="text" placeholder="Enter Name" id="nameLogin" name="nameLogin">
          </div>
        </div>
        <div class="row">
          <div class="four columns">
            <input class="u-full-width" type="text" placeholder="username" id="usernameLogin" name="usernameLogin">
          </div>
        </div>
        <div class="row">
          <div class="four columns">
            <input class="u-full-width" type="password" placeholder="Enter password" id="passwordLogin" name="passwordLogin">
          </div>
          <div class="four columns">
            <input class="u-full-width" type="password" placeholder="Re-enter password" id="repasswordLogin" name="repasswordLogin">
          </div>
        </div>
        <div class="row">
          <div class="eight columns">
            <input class="u-full-width" type="text" placeholder="Enter email address" id="emailLogin" name="emailLogin">
          </div>
        </div>
        <input class="button-primary" type="submit" value="Submit" name="signup">
      </form>
      <h5><?php echo $error; ?></h5>
    </div>
  </div>

</body>
</html>
