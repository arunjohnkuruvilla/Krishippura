<?php 
	require_once('../config.php');
	require_once('../initialize_database.php');
	if(isset($_POST['renameCatSubmit'])) {
		$primary_cat_id = $_POST['primary_select'];
		$new_prim_cat_name = $_POST['renamePrimaryCat'];
		$option_exist = $mysqli->query("SELECT * FROM primary_category WHERE cat_id = '$primary_cat_id'");
		if($option_exist->num_rows == 0) {
			$error = "The option you selected is not present. Kindly choose another one.";
		}
		else {
			$update_primary_cat_name = $mysqli->query("UPDATE primary_category SET `cat_name` = '$new_prim_cat_name' WHERE cat_id = '$primary_cat_id'");
			if($update_primary_cat_name) {
				header("Location:confirmcatmod.php?status=3");
			}
			else {
				$error = "Updating the name of the Primary Category failed. Please try again.";
			}
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
    		<h3>Categories</h3>
    		<!--Form for categorization of articles-->
    		<form action="workspace/cat/renameprimary.php" method="POST" name="renamePrimaryCatForm" id="renamePrimaryCatForm">
	    		<div id="primary_cat">
	    			Primary Category
	    			<select id="primary_select" name="primary_select">		<!--Selection of primary category-->
<?php 

	$get_primary = $mysqli->query("SELECT cat_id, cat_name FROM primary_category");

	echo '<option selected value="0">Select category</option>';				//Default option

	$primary_category_count = $get_primary->num_rows;						//Get number of primary categories
	while($get_primary_list = $get_primary->fetch_assoc()) {
		echo '<option value="'.$get_primary_list['cat_id'].'">'.$get_primary_list['cat_name'].'</option>';
	}
?>
					</select>
	    		</div>
	    		<input id="renamePrimaryCat" name="renamePrimaryCat" type="text" />
	    		<input id="renameCatSubmit" name="renameCatSubmit" class="button-primary" type="submit" value="Submit">
	    	</form>
    	</div>
  	</div>
  	
  	<script src="scripts/jquery.js"></script>
  	<script type="text/javascript">

  	/* Action at form submit */
  	$('#renamePrimaryCatForm').submit(function() {
		var primCat = $('#primary_select').val();
		if(primCat == "0") {											//If primary category not selected
			alert("Please select Primary category.");					
			return false;
		}
		var renamePrimCat = $('#renamePrimaryCat').val();
		if(renamePrimCat == "") {
			alert("Please enter a name for the selected Primary Category.");	//If no new name entered
			return false;
		}
	});
  	</script>
</body>
</html>
