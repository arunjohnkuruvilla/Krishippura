<?php 
	require_once('./config.php');
	require_once("./initialize_database.php");
	session_start();
	$edit_success = "";
	if(isset($_GET['success']) && isset($_GET['article'])) {
		$edit_success = "Article ".$_GET['article']." edited successfully";
	}
	require ($article_link."addarticle.php");
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
    	<div class="container">
    		<!--Here we list all the articles for editting and deleting-->
    		<?php 
    			echo $edit_success;
    			echo "<br/><br/>"
    		?>
    		<!--New Article addition-->
    		<div class="row">
    			<h3>New Article</h3>
    			<!-- Form to add a new article-->
    			<form action="workspace/workspace.php" method="POST" name="newArticleForm" id="newArticleForm">
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
    		<!--New Article addition ends here-->

    		<hr>
    		
    		<div class="row">
    			<h3>User Management</h3>
    			<?php 
    			$unapproved_query = $mysqli->query("SELECT * FROM user WHERE user_status = 0");
    			if($unapproved_query->num_rows != 0) {
    				echo 
    				'<table class="tg" style="undefined;table-layout: fixed; width: 100%;">
						<colgroup>
							<col style="width: 5%">
							<col style="width: 35%">
							<col style="width: 40%">
							<col style="width: 10%">
							<col style="width: 10%">
						</colgroup>';
						while($unapproved_result = $unapproved_query->fetch_assoc()) {
							echo 
						'<tr>
						    <td class="tg-s6z2">'.$unapproved_result['user_id'].'</td>
						    <td class="tg-s6z2">'.$unapproved_result['user_real_name'].'</td>
						    <td class="tg-s6z2">'.$unapproved_result['user_email'].'</td>
						    <td class="tg-s6z2"><a class="button" href="./workspace/user/execute.php?execute=approve&id='.$unapproved_result['user_id'].'" style="width:100%;padding:0">APPROVE</a></td>
						    <td class="tg-s6z2"><a class="button" href="./workspace/user/execute.php?execute=delete&id='.$unapproved_result['user_id'].'" style="width:100%;padding:0">REJECT</a></td>
					  	</tr>';
						}
					echo '</table>';
    			}
    			else {
    				echo "No new Editor Requests";
    			}

    			?>
    		</div>

    		<hr>

    		<!--Category Management-->
    		<div class="row">
    			<h3>Category Management</h3>
		    	<div class="five columns">
		    		<a href="workspace/cat/addprimary.php" class="button" type="submit" onclick="openCategory(this); return false;" target="_blank">Add Primary category</a>
		    	</div>
		    	<div class="five columns">
		    		<a href="workspace/cat/addsecondary.php" class="button" type="submit" onclick="openCategory(this); return false;" target="_blank">Add Secondary category</a>
		    	</div>
		    	<br/>
		    	<br/>
		    	<div class="five columns">
		    		<a href="workspace/cat/renameprimary.php" class="button" type="submit" onclick="openCategory(this); return false;" target="_blank">Rename Primary category</a>
		    	</div>
		    	<div class="five columns">
		    		<a href="workspace/cat/renamesecondary.php" class="button" type="submit" onclick="openCategory(this); return false;" target="_blank">Rename Secondary category</a>
		    	</div>
		    	<br/>
		    	<br/>
		    	<div class="five columns">
		    		<a href="workspace/cat/deleteprimary.php" class="button" type="submit"  onclick="openCategory(this); return false;" target="_blank">Delete Primary category</a>
		    	</div>
		    	<div class="five columns">
		    		<a href="workspace/cat/deletesecondary.php" class="button" type="submit" onclick="openCategory(this); return false;" target="_blank">Delete Secondary category</a>
		    	</div>
    		</div>
    		<!--Category Management ends here-->
    		<hr>
    		<!--Article Management-->
    		<div id="articles_list">
<?php 
	//Displaying uncategorized articles
	$pages_list_query = $mysqli->query("SELECT * FROM page INNER JOIN user ON (page_creator=user_id) WHERE prim_cat = '0' AND sec_cat = '0'");
	echo 	'<h4>Uncategorized</h4>
				<table class="tg" style="undefined;table-layout: fixed; width: 100%">
					<colgroup>
						<col style="width: 3%">
						<col style="width: 40%">
						<col style="width: 25%">
						<col style="width: 3%">
						<col style="width: 4%">
						<col style="width: 4%">
						<col style="width: 6%">
						<col style="width: 9%">
						<col style="width: 6%">
					</colgroup>';
	while($pages_entry = $pages_list_query->fetch_assoc()) {
	   	echo 	'<tr>
					    <td class="tg-s6z2">'.$pages_entry['page_id'].'</td>
					    <td class="tg-s6z2">'.$pages_entry['page_title'].'</td>
					    <td class="tg-s6z2">'.$pages_entry['user_real_name'].'</td>
					    <td class="tg-s6z2"><a class="button" href="'.$article_link.'uploadpdf.php?article='.$pages_entry['page_id'].'" onclick="openCategory(this); return false;" style="width:100%;padding:0">PDF</a></td>
					    <td class="tg-s6z2"><a class="button" href="articles/'.str_replace(" ", "_", $pages_entry['page_title']).'" style="width:100%;padding:0">VIEW</a></td>
					    <td class="tg-s6z2"><a class="button" href="'.$article_link.'editor.php?article='.$pages_entry['page_id'].'" style="width:100%;padding:0">EDIT</a></td>
					    <td class="tg-s6z2"><a class="button" href="'.$article_link.'rename.php?article='.$pages_entry['page_id'].'" onclick="openCategory(this); return false;" style="width:100%;padding:0">RENAME</a></td>
					    <td class="tg-s6z2"><a class="button" href="'.$article_link.'recategorize.php?article='.$pages_entry['page_id'].'" onclick="openCategory(this); return false;" target="_blank" style="width:100%;padding:0">CATEGORIZE</a></td>
					    <td class="tg-s6z2"><a class="button" href="'.$article_link.'execute.php?execute=delete&article='.$pages_entry['page_id'].'" style="width:100%;padding:0">DELETE</a></td>
				  	</tr>';
	}
	echo "</table>";

	//Displaying Articles according to category
	$primary_query = $mysqli->query("SELECT * FROM primary_category");
	while($primary_query_list = $primary_query->fetch_assoc()) {
		$primary_id = $primary_query_list['cat_id'];
		$primary_name = $primary_query_list['cat_name'];
		echo '<h4>'.$primary_name.'</h4>';
		$secondary_query = $mysqli->query("SELECT * FROM secondary_category WHERE primary_cat = '$primary_id'");
		while($secondary_query_list = $secondary_query->fetch_assoc()) {
			$secondary_id = $secondary_query_list['sub_cat'];
			echo '<h5>'.$secondary_query_list['cat_name'].'</h5>';
			$pages_list_query = $mysqli->query("SELECT * FROM page INNER JOIN user ON (page_creator=user_id) WHERE prim_cat = '$primary_id' AND sec_cat = '$secondary_id'");
			while($pages_entry = $pages_list_query->fetch_assoc()) {
		    	echo 		'
		    				<table class="tg" style="undefined;table-layout: fixed; width: 100%">
								<colgroup>
									<col style="width: 3%">
									<col style="width: 40%">
									<col style="width: 25%">
									<col style="width: 3%">
									<col style="width: 4%">
									<col style="width: 4%">
									<col style="width: 6%">
									<col style="width: 9%">
									<col style="width: 6%">
								</colgroup>
		    				<tr>
							    <td class="tg-s6z2">'.$pages_entry['page_id'].'</td>
							    <td class="tg-s6z2">'.$pages_entry['page_title'].'</td>
							    <td class="tg-s6z2">'.$pages_entry['user_real_name'].'</td>
							    <td class="tg-s6z2"><a class="button" href="'.$article_link.'uploadpdf.php?article='.$pages_entry['page_id'].'" onclick="openCategory(this); return false;" style="width:100%;padding:0">PDF</a></td>
							    <td class="tg-s6z2"><a class="button" href="articles/'.str_replace(" ", "_", $pages_entry['page_title']).'" style="width:100%;padding:0">VIEW</a></td>
							    <td class="tg-s6z2"><a class="button" href="'.$article_link.'editor.php?article='.$pages_entry['page_id'].'" style="width:100%;padding:0">EDIT</a></td>
							    <td class="tg-s6z2"><a class="button" href="'.$article_link.'rename.php?article='.$pages_entry['page_id'].'" onclick="openCategory(this); return false;" style="width:100%;padding:0">RENAME</a></td>
							    <td class="tg-s6z2"><a class="button" href="'.$article_link.'recategorize.php?article='.$pages_entry['page_id'].'" onclick="openCategory(this); return false;" target="_blank" style="width:100%;padding:0">CATEGORIZE</a></td>
							    <td class="tg-s6z2"><a class="button" href="'.$article_link.'execute.php?execute=delete&article='.$pages_entry['page_id'].'" style="width:100%;padding:0">DELETE</a></td>
						  	</tr>
						 	</table>
						  	';
			}
		}
	}
?>    
    		</div>	<!--Article management ends here-->
    	</div>		<!--Container ends here-->
    <script type="text/javascript" src="scripts/jquery.js"></script>
  	<script type="text/javascript">
  	$('#newArticleForm').submit(function() {
  		var newArticle = $('#newArticleInput').val();
  		if(newArticle == "") {
  			alert("Please enter the new article's name.");
  			return false;
  		}
  	});
	function openCategory(article) {
	    var x = screen.width/2 - 700/2;
	    var y = screen.height/2 - 450/2;
	    window.open(article.href, 'sharegplus','height=485,width=700,left='+x+',top='+y);
	}
	</script>
</body>
</html>
