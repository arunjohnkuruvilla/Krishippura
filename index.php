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
  <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>

  <!-- CSS -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/custom.css">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="">

  <style type="text/css">
    .shadow {
   -moz-box-shadow:    inset 0 0 10px #000000;
   -webkit-box-shadow: inset 0 0 10px #000000;
   box-shadow:         inset 0 0 10px #000000;
}
  </style>

</head>
<body>
  <!-- Navigation Bar -->
  <?php require("./includes/layout/navbar.php") ?>

  <div style="height:100%;width:100%;background-image:url('images/background.jpg');background-size:100%;background-repeat:no-repeat;" class="shadow">
    <div style="position:absolute;top:40%;left:35%;font-family: 'Quicksand', sans-serif;font-size:6em;color:#fff;margin:auto">AgroDB</div>
  </div>
  <div class="" style="width:100%;height:40%;background: linear-gradient(to bottom,#262b2e 0%,#1d2022 100%);padding:7%">
    <div id="morphsearch" class="morphsearch" style="margin-left: auto;margin-right: auto">
      <form class="morphsearch-form" id="searchForm">
        <input class="morphsearch-input" type="search" placeholder="Start typing..." id="searchInput"/>
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

  <div style="width:100%;padding:5%;background: linear-gradient(to bottom,#262b2e 0%,#1d2022 100%);" class="shadow">
    <div class="container" style="overflow:auto">
      <div class="grid">
          <div id="primary"></div>
        </div>
    </div>
  </div>

  <div id="contact" class="" style="width:100%;height:60%;background-image:url('images/background3.jpg');background-size:150%;background-repeat:no-repeat;padding:10%;text-align:center">
    <div class="container twelve columns">
      <div class="four columns">
        <p>John Smith</p>
        <p>ABC Company</p>
        <p>+91 9876543210</p>
      </div>
      <div class="four columns">
        <p>John Smith</p>
        <p>ABC Company</p>
        <p>+91 9876543210</p>
      </div>
      <div class="four columns">
        <p>John Smith</p>
        <p>ABC Company</p>
        <p>+91 9876543210</p>
      </div>
    </div>
  </div>

  <div style="height:10%;width:100%;background: linear-gradient(to bottom,#262b2e 0%,#1d2022 100%);"></div>
  

  <script type="text/javascript" src="scripts/jquery.js"></script>
  <script type="text/javascript" src="scripts/main.js"></script>
  <script type="text/javascript" src="scripts/classie.js"></script>
</body>
</html>
