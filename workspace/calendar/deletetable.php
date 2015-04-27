<?php 
    require_once('../config.php');
    require_once("../initialize_database.php");
    require_once("../authenticate.php");

    if(isset($_GET['table'])) {
    	$table = $_GET['table'];
		$delete_table = $mysqli->query("DELETE FROM `calendar_tables` WHERE `id` = '$table'");
		if($delete_table) {
			header("Location: ../calendar.php?deletetable=1");
		}  
		else {
			echo'Could not delete the table. Please try again';
		}

	}
	else {
		header("Location: ../calendar.php");
	}
?>
