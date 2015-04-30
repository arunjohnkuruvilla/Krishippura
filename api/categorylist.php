<?php
	require_once('../workspace/config.php');
	require_once('../workspace/initialize_database.php');
	require_once('../workspace/functions.php');

	$get_primary = $mysqli->query("SELECT cat_id, cat_name FROM primary_category");
	
	$arr = array();
	$arr['primary_category_count'] = $get_primary->num_rows;		//number of primary categories

	$arr['primary_category'] = array();

	while($get_primary_list = $get_primary->fetch_assoc()) {
		$primary_category_id = $get_primary_list['cat_id'];
		$primary_category_name = $get_primary_list['cat_name'];
		array_push($arr["primary_category"], $primary_category_name);
	}

	
	$json=json_encode($arr);
	print_r($json);
?>