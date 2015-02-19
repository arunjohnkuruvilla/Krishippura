<?php 
require_once("./initialize_database.php");
require_once("./functions.php");
$article_name = str_replace("_", " ", $_GET['page']);
?>

<!DOCTYPE html>
<html>
<head>
	<base href="/"/>
  	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />

  	<title>Article Preview</title>
  	<link rel="stylesheet" href="css/normalize.css">
  	<link rel="stylesheet" href="css/skeleton.css">
  	<link rel="stylesheet" href="css/custom.css">

<body>

    <!-- Navigation Bar -->
    <?php require("./includes/layout/navbar.php") ?>

    <div class="container" style="padding-top:5rem;padding-bottom:4rem;height:95%">
<?php
$article_details_query = $mysqli->query("SELECT page_title,user_real_name,page_content FROM page INNER JOIN user ON (page_creator=user_id) WHERE page_title='$article_name'");
$article_details = $article_details_query->fetch_assoc(); 
    echo "<h2>".$article_details['page_title']."</h2>";

$article_content = text_to_link($article_details['page_content']);
$article_sections = explode("||sec||",$article_content);
$sections_count = count($article_sections);
	echo "<p>".$article_sections[0]."</p>";
$i = 1;
while($i < $sections_count) {
	$section_title = explode("||ttl||", $article_sections[$i]);
	echo "<h5>".$section_title[0]."</h5>";
	echo "<p>".$section_title[1]."</p>";
	$i++;
}
?>
    </div>
    <footer class="footer">
	    <div class="container">
	    Copyright. All rights reserved.   
	    </div>
  	</footer>
</body>
</html>
