<?php 
	require_once('../config.php');
	require_once('../initialize_database.php');
	$error = "";
	if(isset($_POST['deleteCatSubmit'])) {
		$primary_cat_id = $_POST['primary_select'];
		$option_exist = $mysqli->query("SELECT * FROM primary_category WHERE cat_id = '$primary_cat_id'");
		if($option_exist->num_rows == 0) {
			$error = "The option you selected has already been deleted. Kindly choose another one.";
		}
		else {			
			$default_pages = $mysqli->query("UPDATE page SET prim_cat = '0' , sec_cat = '0' WHERE prim_cat = '$primary_cat_id'");
			if($default_pages) {
				$delete_secondary_cat = $mysqli->query("DELETE FROM secondary_category WHERE primary_cat = '$primary_cat_id'");
				if($delete_secondary_cat) {
					$delete_primary_cat = $mysqli->query("DELETE FROM primary_category WHERE cat_id = '$primary_cat_id'");
					if($delete_primary_cat) {
						header("Location:confirmcatmod.php?status=5");
					}
					else {
						$error = "Deletion of Primary Category failed. Secondary Categories have been deleted. Articles have been uncategorized. Please try again to delete the Crimary Category.";
					}
				}
				else {
					$error = "Deletion of Primary Cateogory and corresponding Secondary Categories have failed. Articles have been uncategorized. Please try again to delete the Primary Category";
				}
			}
			else {
				$error = "Article uncategorization has failed. Please try again.";
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
    		<form action="workspace/cat/deleteprimary.php" method="POST" name="deletePrimaryCatForm" id="deletePrimaryCatForm">
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
	    		<input id="deleteCatSubmit" name="deleteCatSubmit" class="button-primary" type="submit" value="Submit">
	    	</form>
	    	<h5><?php echo $error; ?></h5>
    	</div>
  	</div>
  	
  	<script src="scripts/jquery.js"></script>
  	<script type="text/javascript">

  	/* Action at form submit */
  	$('#deletePrimaryCatForm').submit(function() {
		var primCat = $('#primary_select').val();
		if(primCat == "0") {											//If primary category not selected
			alert("Please select Primary category.");					
			return false;
		}
		var selectedCategory = $('#primary_select :selected').text();
		return(confirm("Are you sure you want to delete '"+ selectedCategory +"' Category?"));
	});
  	</script>
</body>
</html>
