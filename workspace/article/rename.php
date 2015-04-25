<?php 
	require_once('../config.php');
	require_once('../initialize_database.php');
  require_once("../authenticate.php");
  $error = "";
  if(isset($_POST['newArticleNameSubmit'])) {
    $article_id = $_POST['articleID'];
    $new_name = $_POST['newArticleName'];
    $name_check = $mysqli->query("SELECT * FROM page WHERE page_title = '$new_name'");
    if($name_check->num_rows == 0) {
      $update_name = $mysqli->query("UPDATE page SET page_title = '$new_name' WHERE page_id = '$article_id'");
      if($update_name) {
        header("Location: confirm.php?status=1");
      }
      else {
        $error = "Updating Article Name failed. Please try again.";
      }
    }
    else {
      $error = "New Article name already exists or Article name same as before.";
    }
    
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<base href="/"/>
  	<meta charset="utf-8">
  	<title>AgroDB</title>
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
  	<div style="padding-top:5rem">
    	<div class="container">
    		<h3>Rename Article</h3>
    		<!--Form for adding a new category of articles-->
    		<form action="workspace/article/rename.php?article=<?php echo $_GET['article']; ?>" method="POST" name="renameArticleForm" id="renameArticleForm">
          <input type="hidden" value="<?php echo $_GET['article']; ?>" id="articleID" name="articleID"/>
          <p>Article ID : <?php echo $_GET['article'];?></p>
          <p>Current Name : 
          <?php 
          $id = $_GET['article'];
          $article_query = $mysqli->query("SELECT page_title FROM page WHERE page_id = '$id'");
          $article_result = $article_query->fetch_assoc();
          echo $article_result['page_title'];
          ?>
          </p>
    			<input name="newArticleName" id="newArticleName" type="text" placeholder="Enter new article name" />
          <input name="newArticleNameSubmit" class="button-primary" type="submit" value="Submit">
          <p><?php echo $error; ?></p>
	    	</form>
    	</div>
  	</div>

    <script src="scripts/jquery.js"></script>
    <script type="text/javascript">
    $('#renameArticleForm').submit(function() {
      var newArticleName = $('#newArticleName').val();
      if(newArticleName == "") {
        alert("Enter the new name for the article");
        return false;
      }
    });
    </script>
</body>
</html>
