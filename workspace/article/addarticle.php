<?php 
	$response = "";									//variable to hold the error message
	if(isset($_POST['newArticleSubmit'])) {
		$new_article = $_POST['newArticleInput'];
		$name_query = $mysqli->query("SELECT page_title FROM page WHERE page_title='$new_article'");
		if($name_query->num_rows) {
			$response = "<span style='color:red'>The article already exists. Please enter another name.</span>";
		}
		else {
			$name_query = $mysqli->query("INSERT INTO `page` (`page_id`, `prim_cat`, `sec_cat`, `page_title`, `page_creator`, `page_counter`, `page_content`) VALUES (NULL, '0', '0', '$new_article', '$_SESSION[user_id]', NULL, NULL)");
			if($name_query) {
				$response = "<span style='color:green'>New article created</span>";
			}
			else {
				$response = "<span style='color:red'>Article creation failed</span>";
			}
		}
	}
?>