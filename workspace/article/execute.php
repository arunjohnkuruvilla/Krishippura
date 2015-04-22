<?php 
require("../config.php");
require("../initialize_database.php");
require_once("../authenticate.php");

if(isset($_GET['execute'])) {
	if($_GET['execute'] == 'delete') {
		$id = $_GET['article'];
		$update_status = $mysqli->query("DELETE FROM page WHERE page_id='$id'");
	}
	
	if($update_status) {
		header("Location: ../workspace.php");
	}
	else {
		echo "Please try again";
	}
}
?>