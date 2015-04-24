<?php
   require_once('../workspace/config.php');
	require_once('../workspace/initialize_database.php');
  	require_once($article_link.'functions.php');

  	$arr = array();								//Array to hold the JSON

  	if(isset($_GET['query']) ) {					//If only query word parameter present
  		$query = $_GET['query'];
      if(preg_match('/^[a-zA-Z0-9 ]+/', $query) && $query != "") {       //query has only alphanumeric characters
    		if(isset($_GET['primary']) AND isset($_GET['secondary'])) {          //if primary or secondary categories set
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
    		else {                                                               //else query with no parameters
    			$sql_query = "SELECT * FROM page WHERE page_title LIKE '%$query%' OR upper(page_content) LIKE '%$query%'";
    		}

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
     		  		$entry['link'] = str_replace(" ", "_", $search_results['page_title']);

     		  		$content = $search_results['page_content'];
     		  		$word = preg_quote($query);
     		  		$text = preg_match("/[a-zA-Z \.\'\"]{0,40}/m", $content, $matches);

     		  		if($text == 0) continue;
     		  		$entry['content'] = $matches[0].'...';
     		  		array_push($arr, $entry);
  		  	   }
            if(count($arr) == 0) {
               $entry = array();
               $entry['title'] = 0;
               $entry['content'] = "No results found...";
               array_push($arr, $entry);
            }
    		} 
      }
      else {
         $entry = array();
         $entry['title'] = -10;
         $entry['content'] = "Please enter a valid search term.";
         array_push($arr, $entry);
      }
   }
  	$json=json_encode($arr);
	print_r($json);
  	
?>