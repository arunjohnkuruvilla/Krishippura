<?php 
	require_once('../config.php');
	require_once('../initialize_database.php');
	require_once("../authenticate.php");
	$error = "";
	if(isset($_POST['renameTableSubmit'])) {
		$table_id = $_POST['idTable'];
		$table_name = $_POST['renameTableInput'];
		
		$rename_query = $mysqli->query("UPDATE calendar_tables SET name = '$table_name' WHERE id = '$table_id'");
		if($rename_query) {
			header("Location: ../calendar.php?renametable=1");
		}
		else {
			$error = "Renaming failed. Please try again";
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
    		<h3>Rename Table</h3>
    		<!--Form for categorization of articles-->
    		<form action="workspace/calendar/renametable.php?table=<?php echo $_GET['table'];?>" method="POST" name="renameTableForm" id="renameTableForm">
<?php 
	$table = $_GET['table'];
	$get_table = $mysqli->query("SELECT * FROM calendar_tables WHERE id='$table'");
	$table = $get_table->fetch_assoc();

	echo '		<input id="idTable" name="idTable" type="hidden" value="'.$table['id'].'"/>
				<input id="nameTable" name="nameTable" type="hidden" value="'.$table['name'].'"/>
				<p>Current Name : '.$table['name'].'</p>
				<input id="renameTableInput" name="renameTableInput" type="text" placeholder="Enter new name for table"/>
	';
?>
	    		<input id="renameTableSubmit" name="renameTableSubmit" class="button-primary" type="submit" value="Submit">
	    		<?php echo '<p>'.$error.'</p>'; ?>
	    	</form>
    	</div>
  	</div>
  	
  	<script src="scripts/jquery.js"></script>
  	<script type="text/javascript">
  	$('#renameTableForm').submit(function() {
  		var newName = $('#renameTableInput').val();
  		var oldName = $('#nameTable').val();
  		if(newName == "") {
  			alert("Enter a name please");
  			return false;
  		}
  		if(newName == oldName) {
  			alert("Enter a different name please");
  			return false;
  		}
  	});
  	</script>

</body>
</html>
