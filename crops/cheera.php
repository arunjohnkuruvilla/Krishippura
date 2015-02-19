<!DOCTYPE html>
<html lang="en">
<head>
  <base href="/">
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

  <nav class="navbar">
    <div class="container">
      <ul class="navbar-list">
        <li class="navbar-item"><a class="navbar-link" href="#intro">CROPS</a></li>
        <li class="navbar-item"><a class="navbar-link" href="#" data-popover="#codeNavPopover">SOIL TYPES</a></li>
        <li class="navbar-item"><a class="navbar-link" href="#examples">MANURES AND FERTILIZERS</a></li>
        <li class="navbar-item"><a class="navbar-link" href="#" data-popover="#moreNavPopover">WATER HARVESTING</a></li>
      </ul>
    </div>
  </nav>
  <div class="section values" style="background-image: url('./images/cheera.jpg');">
  </div>
  <div style="padding-top:5rem">
    <div class="container">
      <div class="row">
        <a class="button button-primary" href="crops/cheera">Soil Preparation</a>
        <a class="button" href="crops/cheera/sow">Planting Method</a>
        <a class="button" href="crops/cheera/water">Watering Cycle</a>
        <a class="button" href="#">Harvesting</a>
      </div>
      
      <div class="row">
        <a class="button" href="#">Fertilizers</a>
        <a class="button" href="#">Common Pests</a>
        <a class="button" href="#">Anchor button</a>
        <a class="button" href="#">Anchor button</a>
      </div>
    
    <hr>
    <?php if(!isset($_GET['stage'])) {
        echo "
          <h2>STAGE I : SOIL PREPARATION</h2>
          <br>
          <p>  
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
        ";
      } 
      else if($_GET['stage']=="sow") {
        echo "
          <h2>STAGE II :SOWING THE CROP</h2>
          <br>
          <p>  
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
        ";
      }
      else if($_GET['stage']=="water") {
        echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]
          <h2>STAGE III :WATERING TECHNIQUES</h2>
          <br>
          <p>  
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
        ";
      }
    ?>
    </div>
  </div>


</body>
</html>
