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

  <div class="container" style="padding-top:5rem">
    <!--Search Function-->
    <div id="query-section" class="row">
      <div class="twelve columns">
        <form name="searchForm" id="searchForm">
          <input class="u-full-width eleven columns" type="text" placeholder="Start searching..." id="searchInput">
          <div>
          <select id="primary_select" name="primary_select">    <!--Selection of primary category-->
<?php 

  $get_primary = $mysqli->query("SELECT cat_id, cat_name FROM primary_category");

  echo '<option selected value="0">Select Primary category</option>';       //Default option

  $primary_category_count = $get_primary->num_rows;           //Get number of primary categories
  while($get_primary_list = $get_primary->fetch_assoc()) {
    echo '<option value="'.$get_primary_list['cat_id'].'">'.$get_primary_list['cat_name'].'</option>';
  }
?>
          </select>
          </div>
          <div id="secondary_cat"></div>
          <input name="searchSubmit" class="button-primary" type="submit" value="Submit">
        </form>
        
      </div>
      <div class="twelve columns">
        <div id="search_results"></div>
      </div>
    </div>

    <br/>

    <!--Category-wise listing-->
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
  <script type="text/javascript" src="scripts/jquery.js"></script>
  <script type="text/javascript">
  $('#searchForm').submit(function() {
    var searchQuery = $('#searchInput').val();
    var primCat = $('#primary_select').val();

    if(searchQuery == "") {
      alert("Please enter search query.");
      return false;
    }
    if(primCat == 0) {
      var source = 'api/search.php?query=' + searchQuery;
    }
    else {
      var secCat = $('#secondary_select').val();
      if(secCat == 0) {
        var source = 'api/search.php?query=' + searchQuery + "&primary=" + primCat + "&secondary=0";
      }
      else {
        var source = 'api/search.php?query=' + searchQuery + "&primary=" + primCat + "&secondary=" + secCat;
      }
    }
    $.ajax({
      type: 'GET',
      url: source,
      async: false,
      contentType: "application/json",
      dataType: 'json',
      success: function (data) {
        var i;
        var content = "<ul>";
        if(data[0]['title'] <= 0) {
          content += "<li>";
          content += "<h6>" + data[0].content + "</h6>";
          content += "</li>";
        }
        else {
          for(i=0; i < data.length; i++) {
            content += "<li>";
            content += "<h5>" + data[i].title + "</h5>";
            content += "<h6>" + data[i].content + "</h6>";
            content += "</li>";
          }
        }
        
        $('#search_results').html(content);
      },
      error: function (jqXHR, textStatus) {
        alert(textStatus);
      }
    });
    return false;
  });
  $("#primary_select").change(function() {
    var primary_count = <?php echo $primary_category_count; ?>;   //get the primary category count

    /*  Creating the JSON array for populating secondary category 
      The array is populated at client side and inserted into a varible*/
<?php 
  $i = 0;
  $arr = array();                           //Variable to hold the json array
  $get_primary = $mysqli->query("SELECT cat_id, cat_name FROM primary_category");
  $arr['primary_count'] = $primary_category_count;          
  while($get_primary_list = $get_primary->fetch_assoc()) {

    $primary_category_id = $get_primary_list['cat_id'];
    $primary_category_name = $get_primary_list['cat_name'];

    $category = array();

    $get_secondary = $mysqli->query("SELECT * FROM secondary_category WHERE primary_cat = '$primary_category_id'");
    $secondary_category = array();

    $category['secondary_count'] = $get_secondary->num_rows;

    $options = array();

    while($get_secondary_list = $get_secondary->fetch_assoc()) {
      $sub_item = array();
      array_push($sub_item, $get_secondary_list['sub_cat']);
      array_push($sub_item, $get_secondary_list['cat_name']);
      array_push($options, $sub_item);
    }

    $category['options'] = $options;
    $arr[$primary_category_id] = $category;

    $i++;
  }
  $json = json_encode($arr);
  echo "var data = ".$json;
?>          
      $( "select option:selected" ).each(function() {
          var j = data[$(this).val()]['secondary_count'];   //Secondary content count
          var i;
          var content = "";                 //Content for the secondary category dropdown
          content += '<select id="secondary_select" name="secondary_select"><option selected value="0">Select Secondary category</option>';
          for(i = 0; i < j; i++) {
            content += '<option value="' + data[$(this).val()]['options'][i][0] + '">' + data[$(this).val()]['options'][i][1] + '</option>';
          }
          content += '</select>';
          $('#secondary_cat').html("");           //Clearing the secondary category content
          $('#secondary_cat').append(content);        //Adding secondary category dropdown
      });
  }).trigger( "change" );
  </script>
</body>
</html>
