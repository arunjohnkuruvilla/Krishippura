<?php 
    require_once('../config.php');
    require_once("../initialize_database.php");
    require_once("../authenticate.php");

    if(isset($_POST['newTableSubmit'])) {
    	$new_table = htmlspecialchars($_POST['newTableName']);
		$add_new_table = $mysqli->query("INSERT INTO `calendar_tables` (`id`, `name`) VALUES (NULL, '$new_table')");
		if($add_new_table) {
			header("Location: ../calendar.php?newtable=1");
		}  
		else {
			echo'Could not add a new table. Please try again';
		}

	}
	else {
		header("Location: ../calendar.php");
	}
?>
