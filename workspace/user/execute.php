<?php 
require("../config.php");
require("../initialize_database.php");
if(isset($_GET['execute'])) {
	if($_GET['execute'] == 'delete') {
		$id = $_GET['id'];
		$update_status = $mysqli->query("DELETE FROM user WHERE user_id='$id'");
	}
	if($_GET['execute'] == 'approve') {
		$id = $_GET['id'];
		$update_status = $mysqli->query("UPDATE user SET user_status = 1 WHERE user_id='$id'");
	}
	
	if($update_status) {
		header("Location: ../workspace.php");
	}
	else {
		echo "Please try again";
	}
}
?>