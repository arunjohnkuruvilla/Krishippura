<?php 
  require_once('./workspace/config.php');
  require_once("./workspace/initialize_database.php"); 
  $category = 2;
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
      <img src="images/kerala.png" width="768" height="1024" usemap="#kerala" alt="" style="width:65%;height:auto;padding-left:35%">
      <map name="kerala">

        <area alt="Kasaragode" title="Kasaragode" href="#kasaragode" shape="poly" coords="23,20,51,11,108,49,149,88,164,102,169,113,135,125,103,139,91,153,89,166,60,108" style="outline:5px solid #000;">

        <area alt="Kannur" title="Kannur" href="#kannur" shape="poly" coords="95,165,104,175,130,194,151,221,174,245,188,248,205,234,227,223,248,210,269,199,292,192,293,171,261,157,226,142,202,126,189,118,175,107,148,122,120,129,101,137,94,148" style="outline:5px solid #000;">


        
    </map>
      <div id="articles_list">
        
<?php
  $primary_query = $mysqli->query("SELECT * FROM primary_category WHERE cat_id = $category");
  while($primary_query_list = $primary_query->fetch_assoc()) {
    $primary_id = $primary_query_list['cat_id'];
    $primary_name = $primary_query_list['cat_name'];
    $secondary_query = $mysqli->query("SELECT * FROM secondary_category WHERE primary_cat = '$primary_id'");
    while($secondary_query_list = $secondary_query->fetch_assoc()) {
      $secondary_id = $secondary_query_list['sub_cat'];
      echo '<a name="'.strtolower($secondary_query_list['cat_name']).'"></a> ';
      echo '<h4>'.$secondary_query_list['cat_name'].'</h4>';
      echo '<table class="" style="undefined;table-layout: fixed; width: 100%">
        <colgroup>
        <col style="width: 100%">
        </colgroup>';
      $pages_list_query = $mysqli->query("SELECT * FROM page INNER JOIN user ON (page_creator=user_id) WHERE prim_cat = '$primary_id' AND sec_cat = '$secondary_id'");
      while($pages_entry = $pages_list_query->fetch_assoc()) {
          echo    '
                <tr>
                  <td class="tg-s6z2"><a href="articles/'.str_replace(" ", "_", $pages_entry['page_title']).'">'.$pages_entry['page_title'].'</a></td>
                </tr>
                ';
      }
      echo " </table>";
    }
  }
?>  
       
      </div>
    </div>
  </div>
  
  <script type="text/javascript" src="scripts/jquery.js"></script>
  <script type="text/javascript" src="scripts/jquery.rwdImageMaps.min.js"></script>
  <script>
  $(document).ready(function(e) {
    $('img[usemap]').rwdImageMaps();
    
    $('area').on('click', function() {
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        if (target.length) {
          $('html,body').animate({
            scrollTop: target.offset().top
          }, 1000);
          return false;
        }
      }
    });
  });
  </script>

</body>
</html>
