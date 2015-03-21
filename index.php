<?php 
  require_once('./workspace/config.php');
  require_once("./workspace/initialize_database.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>AgroDB</title>
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
      <div id="query-section" class="row">
        <div class="eleven columns">
          <input class="u-full-width" type="text" placeholder="Enter your query here..." id="mainSearchInput">
        </div>
      </div>
      <br/>
<?php 
$main_categories = $mysqli->query("SELECT * FROM primary_category");
while($main_categories_list = $main_categories->fetch_assoc()) {
  echo '<a href="category.php?category='.$main_categories_list['cat_id'].'">
        <div id="'.$main_categories_list['cat_name'].'-section" class="row" style="height:20em;background:url(./images/front-page-'.$main_categories_list['cat_name'].'.jpg)">
          <h2 style="padding:1em">'.$main_categories_list['cat_name'].'</h2>
        </div>
      </a>';
}

?>
      <br/>
      <br/>
    </div>
  </div>
  

</body>
</html>
