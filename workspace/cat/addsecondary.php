<?php 
	require_once('../config.php');
	require_once('../initialize_database.php');
  require_once("../authenticate.php");
	$primary_cat = "";
	$secondary_cat = "";
  $error = "";
  if(isset($_POST['newSecondaryCatSubmit'])) {
    $primary_category = $_POST['primary_select'];
    $new_category = $_POST['newSecondaryCat'];

    $check_category = $mysqli->query("SELECT * FROM secondary_category WHERE primary_cat = '$primary_category' AND cat_name = '$new_category'");
    if($check_category->num_rows != 0) {
      $error = "The Secondary Category already exists for the selected primary category. Please provide a new one.";
    }
    else {
      //Incrementing secondary category ID
      $get_prev_sub_cat = $mysqli->query("SELECT MAX(sub_cat) AS max_count FROM secondary_category WHERE primary_cat = '$primary_category'");
      $get_prev_sub_cat_list = $get_prev_sub_cat->fetch_assoc();
      if($get_prev_sub_cat_list['max_count'] != NULL) {
        $current_count = $get_prev_sub_cat_list['max_count'] + 1;
      }
      else {
        $current_count = 1;
      }

      //Adding new secondary category to the list
      $update_secondary = $mysqli->query("INSERT INTO `secondary_category` (`cat_id`, `primary_cat`, `sub_cat`, `cat_name`) VALUES (NULL, '$primary_category', '$current_count', '$new_category')");
      if($update_secondary) {
        header("Location:confirmcatmod.php?status=2");
      }
      else {
        $error = "Adding the new secondary category failed";
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<base href="/"/>
  <meta charset="utf-8">
  <title>Krishipurra</title>
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

 	<div class="container" style="padding-top:5rem">
 		<h3>New Secondary Category</h3>
 		<!--Form for adding a new secondary category of articles-->
 		<form action="workspace/cat/addsecondary.php" method="POST" name="addSecondaryCatForm" id="addSecondaryCatForm">
      <div id="primary_cat">
        <?php 
          echo $primary_cat;
          echo $secondary_cat;?>
        Primary Category
        <select id="primary_select" name="primary_select">    <!--Selection of primary category-->
<?php 

  $get_primary = $mysqli->query("SELECT cat_id, cat_name FROM primary_category");

  echo   '<option selected value="0">Select category</option>';       //Default option

  $primary_category_count = $get_primary->num_rows;           //Get number of primary categories
  while($get_primary_list = $get_primary->fetch_assoc()) {
    echo '<option value="'.$get_primary_list['cat_id'].'">'.$get_primary_list['cat_name'].'</option>';
  }
?>
        </select>
      </div>
          
    	<input name="newSecondaryCat" id="newSecondaryCat" type="text" placeholder="Enter new category" />
      <input name="newSecondaryCatSubmit" class="button-primary" type="submit" value="Submit">
      <p style="color:red"><?php echo $error; ?></p>
	  </form>
  </div>
    <script src="scripts/jquery.js"></script>
    <script type="text/javascript">
    $('#addSecondaryCatForm').submit(function() {
      var primCat = $('#primary_select').val();
      if(primCat == 0) {
        alert("Select Primary Category.");
        return false;
      }
      var newSecCat = $('#newSecondaryCat').val();
      if(newSecCat == "") {
        alert("Enter name of new Secondary Category");
        return false;
      }
    });
    </script>
</body>
</html>
