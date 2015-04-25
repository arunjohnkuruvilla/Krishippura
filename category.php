<?php 
  require_once('./workspace/config.php');
  require_once("./workspace/initialize_database.php"); 
  if(isset($_GET['category'])) {
    $category = $_GET['category'];
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <base href="/" />
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
<body style="background-color:#fff">

  <!-- Navigation Bar -->
  <?php require("./includes/layout/navbar.php") ?>

    <div class="container" style="padding-top:10em">
      <div id="articles_list" style="height:auto">
        
<?php
  $primary_query = $mysqli->query("SELECT * FROM primary_category WHERE cat_id = $category");
  while($primary_query_list = $primary_query->fetch_assoc()) {
    $primary_id = $primary_query_list['cat_id'];
    $primary_name = $primary_query_list['cat_name'];
    echo '<h1>'.$primary_name.'</h1>';
    $secondary_query = $mysqli->query("SELECT * FROM secondary_category WHERE primary_cat = '$primary_id'");
    while($secondary_query_list = $secondary_query->fetch_assoc()) {
      $secondary_id = $secondary_query_list['sub_cat'];
      echo '<div style="width:100%;position:relative;float:left"><h4>'.$secondary_query_list['cat_name'].'</h4><div class="grid2">';
      
      //echo '<table class="" style="undefined;table-layout: fixed; width: 100%"> <colgroup> <col style="width: 100%"> </colgroup>';
      $pages_list_query = $mysqli->query("SELECT * FROM page INNER JOIN user ON (page_creator=user_id) WHERE prim_cat = '$primary_id' AND sec_cat = '$secondary_id'");
      while($pages_entry = $pages_list_query->fetch_assoc()) {
          echo '
          <figure class="effect-lily">';
          if($pages_entry['thumbnail_status']) {
            echo '<img src="images/thumbs/'.str_replace(" ", "_", $pages_entry['page_title']).'.jpg" alt="img12"/>';
          }
          echo '
            
            <figcaption>
              <div>
                <h2>'.$pages_entry['page_title'].'</h2>
              </div>
              <a href="articles/'.str_replace(" ", "_", $pages_entry['page_title']).'">View more</a>
            </figcaption>     
          </figure>
        ';
          //echo    ' <tr> <td class="tg-s6z2"><a href="articles/'.str_replace(" ", "_", $pages_entry['page_title']).'">'.$pages_entry['page_title'].'</a></td> </tr> ';
      }
      //echo " </table>";
      echo '</div></div>';
    }
  }
?>  
       
      </div>
    </div>
  

</body>
</html>
