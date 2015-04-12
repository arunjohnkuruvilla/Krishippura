<?php
  	require_once('../workspace/config.php');
	require_once('../workspace/initialize_database.php');
  	require_once('../workspace/functions.php');

  	$arr = array();								//Array to hold the JSON

  	if(isset($_GET['query']) ) {					//If only query word parameter present
  		$query = $_GET['query'];

  		if(isset($_GET['primary']) AND isset($_GET['secondary'])) {
  			$primary_cat = $_GET['primary'];
  			$secondary_cat = $_GET['secondary'];
  			if($primary_cat == "0"){
  				//echo '$primary_cat == "0"';
  				//echo '<br/>';
  				$sql_query = "SELECT * FROM page WHERE page_title LIKE '%$query%' OR upper(page_content) LIKE '%$query%'";
  			}
  			else if($primary_cat != "0" AND $secondary_cat == "0") {
  				//echo '$primary_cat != "0" AND $secondary_cat == "0"';
  				//echo '<br/>';
  				$sql_query = "SELECT * FROM page WHERE (page_title LIKE '%$query%' OR upper(page_content) LIKE '%$query%') AND prim_cat = '$primary_cat'";
  			}
  			else {
  				//echo '$primary_cat != "0" AND $secondary_cat != "0"';
  				//echo '<br/>';
  				$sql_query = "SELECT * FROM page WHERE (page_title LIKE '%$query%' OR upper(page_content) LIKE '%$query%') AND prim_cat = '$primary_cat' AND sec_cat = '$secondary_cat'";
  			}
  		}		
  		else {
  			$sql_query = "SELECT * FROM page WHERE page_title LIKE '%$query%' OR upper(page_content) LIKE '%$query%'";
  		}
  		
  		//echo $sql_query;
  		//echo '<br/>';
  		$search_database = $mysqli->query($sql_query);
  		if($search_database->num_rows == 0) {
  			$entry = array();
	  		$entry['title'] = 0;
	  		$entry['content'] = "No results found...";
	  		array_push($arr, $entry);
  		}
  		else {
  			while($search_results = $search_database->fetch_assoc()) {
			  	$entry = array();
		  		$entry['title'] = $search_results['page_title'];

		  		$content = $search_results['page_content'];
		  		$word = preg_quote($query);
		  		$text = preg_match_all("~\b([a-zA-Z ]{0,10})($word)([a-zA-Z ]{0,20})\b~", $content, $matches);

		  		if($text == 0) continue;
		  		$entry['content'] = '...'.$matches[0][0].'...';
		  		array_push($arr, $entry);
		  	}
  		} 
  	}
  	else {
  		$entry = array();
  		$entry['title'] = -10;
  		$entry['content'] = "Please enter a search term.";
  		array_push($arr, $entry);
  	}
  
  	$json=json_encode($arr);
	print_r($json);
  	
?>