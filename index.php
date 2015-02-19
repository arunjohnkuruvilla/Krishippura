<?php require_once("./initialize_database.php"); ?>
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

  <nav class="navbar">
    <div class="container">
      <ul class="navbar-list">
        <li class="navbar-item"><a class="navbar-link" href="#">CROPS</a></li>
        <li class="navbar-item"><a class="navbar-link" href="#">SOIL TYPES</a></li>
        <li class="navbar-item"><a class="navbar-link" href="#">MANURES AND FERTILIZERS</a></li>
        <li class="navbar-item"><a class="navbar-link" href="#">WATER HARVESTING</a></li>
      </ul>
      <ul class="navbar-list" style="float:right">
        <li class="navbar-item"><a class="navbar-link" href="login.php">LOGIN</a></li>
      </ul>
    </div>
  </nav>
  <div style="padding-top:5rem">
    <div class="container">
      <div class="row">
        <div class="eleven columns">
          <input class="u-full-width" type="text" placeholder="Enter your query here..." id="mainSearchInput">
        </div>
      </div>
      <br/>
      <br/>
      <div id="articles_list">
        <table class="" style="undefined;table-layout: fixed; width: 100%">
        <colgroup>
        <col style="width: 100%">
        </colgroup>
<?php 
  $pages_list_query = $mysqli->query("SELECT page_id,page_title,user_real_name FROM page INNER JOIN user ON (page_creator=user_id)");
  while($pages_entry = $pages_list_query->fetch_assoc()) {
      echo   '<tr>
                <td class="tg-s6z3"><a href=articles/'.str_replace(" ", "_", $pages_entry['page_title']).'>'.$pages_entry['page_title'].'</a></td>
              </tr>';
  }
?>
        </table>
        </div>

    </div>

  </div>
  

</body>
</html>
