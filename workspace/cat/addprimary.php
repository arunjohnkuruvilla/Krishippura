<?php 
	require_once('../config.php');
	require_once('../initialize_database.php');
	$primary_cat = "";
	$secondary_cat = "";
  $error = "";
  if(isset($_POST['newCategorySubmit'])) {
    $new_category = $_POST['newPrimaryCat'];
    $category_query = $mysqli->query("SELECT cat_name FROM primary_category WHERE cat_name = '$new_category'");
    if($category_query->num_rows == 0) {
      $category_insert = $mysqli->query("INSERT INTO `prototype`.`primary_category` (`cat_id`, `cat_name`) VALUES (NULL, '$new_category')");
      header("Location:confirmcatmod.php?status=1");
    }
    else {
      $error = "The primary category name already exists. Please select a new one.";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<base href="/"/>
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
  	<div style="padding-top:5rem">
    	<div class="container">
    		<h4>Categories</h4>
    		<!--Form for adding a new category of articles-->
    		<form action="workspace/cat/addprimary.php" method="POST" name="addPrimaryCatForm" id="addPrimaryCatForm">
          <h3>New Primary Category</h3>
    			<input name="newPrimaryCat" id="newPrimaryCat" type="text" placeholder="Enter new category" />
          <input name="newCategorySubmit" class="button-primary" type="submit" value="Submit">
          <p><?php echo $error; ?></p>
	    	</form>
    	</div>
  	</div>

    <script src="scripts/jquery.js"></script>
    <script type="text/javascript">
    $('#addPrimaryCatForm').submit(function() {
      var newPrimCat = $('#newPrimaryCat').val();
      if(newPrimCat == "") {
        alert("Enter name of new Primary Category");
        return false;
      }
    });
    </script>
</body>
</html>
