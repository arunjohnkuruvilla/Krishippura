<?php 
    require_once('../config.php');
    require_once("../initialize_database.php");
    require_once("../authenticate.php");

    if(isset($_GET['id'])) {
    	$table = $_GET['id'];
		$delete_table = $mysqli->query("DELETE FROM `calendar` WHERE `id` = '$table'");
		if($delete_table) {
			header("Location: ../calendar.php?deleterow=1");
		}  
		else {
			echo'Could not delete the table. Please try again';
		}

	}
	else {
		header("Location: ../calendar.php");
	}
?>
