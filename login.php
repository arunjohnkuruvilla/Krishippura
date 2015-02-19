<?php 
if(isset($_POST['login'])){
  if(($_POST['usernameLogin'] == "admin") && ($_POST['passwordLogin'] == "admin")) {
    session_start();
    $_SESSION['user_id'] = 1;
    header("Location: workspace.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Cheera</title>
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
  <?php require("./includes/layout/navbar.php") ?>

  <div style="padding-top:5rem">
    <div class="container">
      <div class="row">
        <form action="#", method="POST">
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
      </div>
    </div>

  </div>
  

</body>
</html>
