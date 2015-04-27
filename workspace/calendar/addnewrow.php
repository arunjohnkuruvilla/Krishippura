<?php 
    require_once('../config.php');
    require_once("../initialize_database.php");
    require_once("../authenticate.php");

    if(isset($_GET['table'])) {
    	$table = $_GET['table'];
    	$add_new_row = $mysqli->query("INSERT INTO `calendar` (`id`, `table`, `column1`, `column2`, `column3`, `column4`, `column5`, `column6`, `column7`) VALUES (NULL, '$table', 'NIL', 'NIL', 'NIL', 'NIL', 'NIL', 'NIL', 'NIL')");
	    if($add_new_row) {
	    	header("Location: ../calendar.php?newtable=1");
	    }
	    else {
	    	echo "Adding a new row failed. Please try again";
	    }
    }
    else {
    	header("Location: ../calendar.php?newtable=1");
    }
    
?>