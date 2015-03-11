<?php 
	require_once('./config.php');
	require_once("./initialize_database.php");
	$edit_success = "";
	if(isset($_GET['success']) && isset($_GET['article'])) {
		$edit_success = "Article ".$_GET['article']." edited successfully";
	}
	require ("./addarticle.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<base href="/" />
  <meta charset="utf-8">
  <title>Workspace</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/custom.css">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="">

</head>
<body>

	<!-- Navigation Bar -->
 	<?php require("../includes/layout/navbar.php") ?>

  	<div style="padding-top:5rem">
    	<div class="container">
    		<!--Here we list all the articles for editting and deleting-->
    		<?php 
    			echo $edit_success;
    			echo "<br/><br/>"
    		?>
    		<div class="row">
    			<h3>New Article</h3>
    			<!-- Form to add a -->
    			<form action="#" method="POST" name="newArticleForm">
		    		<div class="five columns">
		    			<input class="u-full-width" type="text" placeholder="article name" id="newArticleInput" name="newArticleInput">
		    		</div>
		    		<div class="five columns">
		    			<input class="button-primary" type="submit" value="Submit" name="newArticleSubmit">
		    		</div>
		    		<br/>
		    		<br/>
		    		<div class="five columns">
		    			<?php echo $response; ?>
		    		</div>
		    		
		    	</form>
    		</div>
    		<hr>
    		<div id="articles_list">
    			<h3>Current Articles</h3>
				<table class="tg" style="undefined;table-layout: fixed; width: 100%">
				<colgroup>
				<col style="width: 10%">
				<col style="width: 40%">
				<col style="width: 20%">
				<col style="width: 6%">
				<col style="width: 6%">
				<col style="width: 10%">
				<col style="width: 8%">
				</colgroup>
				  	<tr>
				    <th class="tg-s6z2">Page ID</th>
				    <th class="tg-s6z2">Page Title</th>
				    <th class="tg-s6z2">Page Author</th>
				    <th></th>
				    <th></th>
				    <th></th>
				  	</tr>
<?php 
	$pages_list_query = $mysqli->query("SELECT page_id,page_title,user_real_name FROM page INNER JOIN user ON (page_creator=user_id)");
	while($pages_entry = $pages_list_query->fetch_assoc()) {
    	echo 		'<tr>
					    <td class="tg-s6z2">'.$pages_entry['page_id'].'</td>
					    <td class="tg-s6z2">'.$pages_entry['page_title'].'</td>
					    <td class="tg-s6z2">'.$pages_entry['user_real_name'].'</td>
					    <td class="tg-s6z2"><a class="button" href="articles/'.str_replace(" ", "_", $pages_entry['page_title']).'" style="width:100%;padding:0">VIEW</a></td>
					    <td class="tg-s6z2"><a class="button" href="./workspace/editor.php?article='.$pages_entry['page_id'].'" style="width:100%;padding:0">EDIT</a></td>
					    <td class="tg-s6z2"><a class="button" href="./workspace/recategorize.php?article=1" onclick="goclicky(this); return false;" target="_blank" style="width:100%;padding:0">CATEGORIZE</a></td>
					    <td class="tg-s6z2"><a class="button" href="#" style="width:100%;padding:0">DELETE</a></td>
				  	</tr>';
	}
?>
				  
				</table>
    		</div>

    	</div>
	</div>
  	<script type="text/javascript">
	function goclicky(meh) {
	    var x = screen.width/2 - 700/2;
	    var y = screen.height/2 - 450/2;
	    window.open(meh.href, 'sharegplus','height=485,width=700,left='+x+',top='+y);
	}
	</script>
</body>
</html>
