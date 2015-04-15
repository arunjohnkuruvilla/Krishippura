<?php 
  require("./config.php");
  require("./initialize_database.php");
  $error = "";
  if(isset($_POST['login'])){
    if(isset($_POST['usernameLogin']) AND isset($_POST['passwordLogin']) AND $_POST['usernameLogin'] != "" AND $_POST['passwordLogin'] != "") {
      $username = $_POST['usernameLogin'];
      $password = $_POST['passwordLogin'];
      $user_check = $mysqli->query("SELECT * FROM user WHERE user_name = '$username' AND user_password = '$password' AND user_status = 1");
      if($user_check->num_rows == 1) {
        session_start();
        $_SESSION['user_id'] = 1;
        header("Location: ./workspace.php");
      }
      else {
        $error = "Invalid username or password";
      }
    }
    else {
      $error = "Please enter both fields";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <base href="/" >
  <meta charset="utf-8">
  <title>Editor Login</title>
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
  <?php include("../includes/layout/navbar.php") ?>

  <div style="padding-top:5rem">
    <div class="container">
      <div class="row">
        <form action="./workspace/login.php", method="POST">
          <div class="row">
            <div class="four columns">
              <input class="u-full-width" type="text" placeholder="username" id="usernameLogin" name="usernameLogin">
            </div>
          </div>
          <div class="row">
            <div class="four columns">
              <input class="u-full-width" type="password" placeholder="password" id="passwordLogin" name="passwordLogin">
            </div>
          </div>
          <input class="button-primary" type="submit" value="Submit" name="login">
        </form>
        <h5><?php echo $error; ?></h5>
      </div>
    </div>

  </div>
  

</body>
</html>
