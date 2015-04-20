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

  <div class="container" style="padding-top:5rem">
    <!--Search Function-->
    <div id="query-section" class="row">
      <div class="twelve columns">
        <form name="searchForm" id="searchForm">
          <div class="six columns">
            <input type="text" placeholder="Start searching..." id="searchInput" class="nine columns"  style="margin-right:2%">
            <input name="searchSubmit" class="button-primary" type="submit" value="Submit">
          </div>
          <div class="button three columns" id="advance_trigger">Advanced Options</div>

          <br/>
          <div id="advanced" style="display:none" class="twelve columns">
            <div id="primary_cat" class="three columns" style="margin-left:0"></div>
            <div id="secondary_cat" class="three columns" style="margin-left:0"></div>
          </div>
          
          
        </form>
      </div>
      <!--Search results-->
        <div id="search_results" class="twelve columns" style="display:none"></div>
    </div>
    <!--Primary Category Listing-->
    <div id="primary"></div>
  </div>
  <script type="text/javascript" src="scripts/jquery.js"></script>
  <script type="text/javascript" src="scripts/main.js"></script>
</body>
</html>
