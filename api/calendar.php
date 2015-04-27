<?php
	require_once('../workspace/config.php');
	require_once('../workspace/initialize_database.php');
	require_once('../workspace/article/functions.php');

	$result = $mysqli->query("SELECT * FROM calendar_tables");

	$arr = array();
	while($row = $result->fetch_assoc()) {
		$table = array();
		$table['name'] = $row['name'];

		$id = $row['id'];
		$row_content = array();
		$row_query = $mysqli->query("SELECT * FROM calendar WHERE `table` = '$id'");
		while($row_result = $row_query->fetch_assoc()) {
			$row_item = array();
			array_push($row_item, $row_result['column1']);
			array_push($row_item, $row_result['column2']);
			array_push($row_item, $row_result['column3']);
			array_push($row_item, $row_result['column4']);
			array_push($row_item, $row_result['column5']);
			array_push($row_item, $row_result['column6']);
			array_push($row_item, $row_result['column7']);
			array_push($row_content, $row_item);
		} 
		$table['rows'] = $row_content;
		array_push($arr, $table);
	}
	$json=json_encode($arr);
	print_r($json);
?>