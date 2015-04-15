<?php 
	require_once('../config.php');
	require_once('../initialize_database.php');
	if(isset($_GET['primary_select']) && isset($_GET['secondary_select'])) {
		$article = $_GET['article'];
		$primary_cat = $_GET['primary_select'];
		$secondary_cat = $_GET['secondary_select'];
		$change_category = $mysqli->query("UPDATE page SET prim_cat = '$primary_cat', sec_cat = '$secondary_cat' WHERE page_id = '$article'");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<base href="/" />
	<title></title>
</head>
<body>
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
      window.close();
});
</script>
</body>
</html>