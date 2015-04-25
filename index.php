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

  <div style="height:100%;width:100%;background-image:url('images/background.jpg');background-size:100%;background-repeat:no-repeat"></div>
  <div class="" style="width:100%;height:30%;background-color:rgba(0,0,0,0.2);padding:5%">
    <div id="morphsearch" class="morphsearch" style="margin-left: auto;margin-right: auto">
      <form class="morphsearch-form" id="searchForm">
        <input class="morphsearch-input" type="search" placeholder="Search..." id="searchInput"/>
        <input class="morphsearch-submit" type="submit" id="searchSubmit" value="Search"/>
        <div class="twelve columns">
          <div class="button three columns advanced_trig" id="advanced_trigger">Advanced Options</div>
        </div>
        <div id="advanced" class="advanced">
          <div id="primary_cat" class="three columns" style="margin-left:0;margin-top:10px"></div>
          <div id="secondary_cat" class="three columns" style="margin-left:10px;margin-top:10px"></div>
        </div>
      </form>
      <div class="morphsearch-content">
        <div id="search_results" class="twelve columns" style="z-index:999;height:50%"></div>
      </div>
      <span class="morphsearch-close"></span>
    </div>
    <div class="overlay"></div>
  </div>

  <div style="width:100%;padding:5%">
    <div class="container" style="overflow:auto">
      <div class="grid">
          <div id="primary"></div>
        </div>
    </div>
  </div>

  <div class="" style="width:100%;height:50%;background-color:rgba(0,0,0,0.2);padding:10%">
  </div>

  <div style="height:10%;width:100%;"></div>
  

  <script type="text/javascript" src="scripts/jquery.js"></script>
  <script type="text/javascript" src="scripts/main.js"></script>
  <script type="text/javascript" src="scripts/classie.js"></script>
</body>
</html>
