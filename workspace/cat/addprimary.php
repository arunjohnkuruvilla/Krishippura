<?php 
	require_once('../config.php');
	require_once('../initialize_database.php');
	$primary_cat = "";
	$secondary_cat = "";
	if(isset($_GET['article'])) {
		$article = $_GET['article'];
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
    		<form action="workspace/confirmaddprimary.php" method="POST" name="addCategoryForm" id="addCategoryForm">
    			<input name="article" value="<?php echo $article; ?>" type="hidden"/>
    			
	    	</form>
    	</div>
  	</div>
</body>
</html>
