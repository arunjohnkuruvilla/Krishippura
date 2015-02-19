<?php 
	require_once("./initialize_database.php");
  require_once("./functions.php");

	if(isset($_POST['update_changes'])) {
		$article_id = $_POST['article_id'];
		$article_content = $_POST['content'];
    echo $article_id;
		$update_query = $mysqli->query("UPDATE `page` SET `page_content` = '$article_content' WHERE `page_id` = '$article_id'");
		echo $update_query;
    if($update_query) {
			header("Location:workspace.php?success=1&article=".$article_id);
		}
	}
	else {
		$article_id = $_GET['article'];
		$article_content = $_POST['content']; 	//this will hold the content to be sent to the database
		$article_display = text_to_link($article_content); 	//this will be the content that we will parse to display.
	}
?>
<!DOCTYPE html>

<html>
<head>
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />

  <title>Article Preview</title>
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/custom.css">

<body>

    <!-- Navigation Bar -->
    <?php require("./includes/layout/navbar.php") ?>

    <div class="container" style="padding-top:5rem;padding-bottom:4rem;height:95%">
    	   
        <form method="post" action="#" id="article_preview_form" name="article_preview_form">

          	<!-- This hidden text is where the content in the blob form will be stored for sending to the database.-->   
          	<input type="hidden" id="article_id" name="article_id" value="<?php echo $article_id; ?>">
          	<input type="hidden" id="content" name="content" value="<?php echo str_replace('"', '&quot;', $article_content);?>" />

            <!-- update button -->
            <input name="update_changes" type="submit" value="Save All Changes" />
            <input name="cancel_changes" type="submit" value="Discard Changes" />
        </form>
<?php
    echo "Article ID : <b>".$article_id."</b> <br/>";
$article_details_query = $mysqli->query("SELECT page_title,user_real_name FROM page INNER JOIN user ON (page_creator=user_id) WHERE page_id='$article_id'");
$article_details = $article_details_query->fetch_assoc(); 
    echo "Article Name : ".$article_details['page_title']."<br/>";
    echo "Article Author : ".$article_details['user_real_name']."<br/><br/><br/>";
    echo "<h4>Preview</h4>";
 
$article_sections = explode("||sec||",$article_display);
$sections_count = count($article_sections);
	echo "<h5>Introduction</h5>";
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
