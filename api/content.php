<?php
	require_once('../config.php');
	require_once('../initialize_database.php');
	require_once('../functions.php');

	$article_name = str_replace("_", " ", $_GET['page']);

	$query = "SELECT * FROM `page` WHERE `page_title`='$article_name'";
	$result = $mysqli->query($query);
	$row = $result->fetch_assoc();

	$arr = array();
	$arr['title'] = $row['page_title'];

	$desc = str_replace(array('<b>','</b>','<i>','</i>'),' ',$row['page_content']);
	$desc = "Introduction||ttl||".$desc;
	$desc = text_to_link($desc);
	$sections = explode("||sec||", $desc);
	$arr['sections_count']=count($sections);
	$j=count($sections);
	$i=0; 
	while($i<$j)
	{
		$indexa="tab".($i+1);
		//$content[$i] = preg_replace('/src=\"/', 'src="http://www.tathva.org/organiser/', $content[$i]);
		$tabsplit = explode("||ttl||", $sections[$i]);
		$arr["section_head"][$i] = $tabsplit[0];
		$arr[$indexa][0]=$tabsplit[0];
		$arr[$indexa][1]=$tabsplit[1];
		$i=$i+1;
	}
	$json=json_encode($arr);
	print_r($json);
?>