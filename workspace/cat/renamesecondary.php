<?php 
	require_once('../config.php');
	require_once('../initialize_database.php');
	if(isset($_POST['renameCatSubmit'])) {
		$primary_cat_id = $_POST['primary_select'];
		$secondary_cat_id = $_POST['secondary_select'];
		$new_sec_cat_name = $_POST['renameSecondaryCat'];
		$option_exist = $mysqli->query("SELECT * FROM secondary_category WHERE primary_cat = '$primary_cat_id' AND sub_cat = '$secondary_cat_id'");
		if($option_exist->num_rows == 0) {
			$error = "The option you selected is not present. Kindly choose another one.";
		}
		else {
			$update_secondary_cat_name = $mysqli->query("UPDATE secondary_category SET `cat_name` = '$new_sec_cat_name' WHERE primary_cat = '$primary_cat_id' AND sub_cat = '$secondary_cat_id'");
			if($update_secondary_cat_name) {
				header("Location:confirmcatmod.php?status=4");
			}
			else {
				$error = "Updating the name of the Secondary Category failed. Please try again.";
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
    		<form action="workspace/cat/renamesecondary.php" method="POST" name="renameSecondaryCatForm" id="renameSecondaryCatForm">
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
	    		<div id="secondary_cat"></div>
	    		<input id="renameSecondaryCat" name="renameSecondaryCat" type="text" />
	    		<input id="renameCatSubmit" name="renameCatSubmit" class="button-primary" type="submit" value="Submit">
	    	</form>
    	</div>
  	</div>
  	
  	<script src="scripts/jquery.js"></script>
  	<script type="text/javascript">

  	/* Action at form submit */
  	$('#renameSecondaryCatForm').submit(function() {
		var primCat = $('#primary_select').val();
		if(primCat == "0") {											//If primary category not selected
			alert("Please select Primary category.");					
			return false;
		}
		var secCat = $('#secondary_select').val();
		if(secCat == "0") {												//If secondary category not selected			
			alert("Please select a Secondary category");
			return false;
		}
		var renameSecCat = $('#renameSecondaryCat').val();
		if(renameSecCat == "") {
			alert("Please enter a name for the selected Secondary Category.");	//If no new name entered
			return false;
		}
	});

	/* Action at option change */
  	$("#primary_select").change(function() {
		var primary_count = <?php echo $primary_category_count; ?>;		//get the primary category count

		/*	Creating the JSON array for populating secondary category 
			The array is populated at server side side and inserted into a varible "data"*/
		<?php 
			$i = 0;
			$arr = array();														//Variable to hold the json array
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
	      	var j = data[$(this).val()]['secondary_count'];		//Secondary content count
	      	var i;
	      	var content = "";									//Content for the secondary category dropdown
	      	content += "Secondary Category ";
	      	content += '<select id="secondary_select" name="secondary_select"><option selected value="0">Select category</option>';
	      	for(i = 0; i < j; i++) {
	      		content += '<option value="' + data[$(this).val()]['options'][i][0] + '">' + data[$(this).val()]['options'][i][1] + '</option>';
	      	}
	      	content += '</select>';
	      	$('#secondary_cat').html("");						//Clearing the secondary category content
	      	$('#secondary_cat').append(content);				//Adding secondary category dropdown
	    });
	}).trigger( "change" );
	

  	</script>
</body>
</html>
