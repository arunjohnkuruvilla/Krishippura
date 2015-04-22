<?php 
	require_once('../config.php');
	require_once('../initialize_database.php');
  require_once("../authenticate.php");
  $error = "";
  if(isset($_POST['uploadSubmit'])) {
    $id = $_POST['primary_select'];
    if(!empty($_FILES["imageFile"])) {

      $pdf = $_FILES["imageFile"];

      if($pdf["error"] !== UPLOAD_ERR_OK) {
        $error = "An error occured during the file upload.";
      }

      $finfo = finfo_open(FILEINFO_MIME_TYPE);
      $mime = finfo_file($finfo, $pdf['tmp_name']);
      if($mime == "image/jpeg") {
        $name = $pdf['name'];

        $article_query = $mysqli->query("SELECT * FROM primary_category WHERE cat_id = '$id'");
        $article_result = $article_query->fetch_assoc();

        $name = str_replace(" ", "_", $article_result['cat_name'].".jpg");

        $success = move_uploaded_file($pdf["tmp_name"], UPLOAD_IMAGE_DIR.$name);

        if(!$success) {
          $error = "Unable to save the file. Please try again.";
        }
        else {
          chmod(UPLOAD_IMAGE_DIR.$name, 0644);
          header("Location: confirmcatmod.php?status=7");
        }
      }
      else {
        $error = "Incorrect format of the upload.";
      }
    }
    else {
      $error = "Please select a file to upload.";
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

 	<div class="container" style="padding-top:5rem">
 		<h3>Upload image</h3>
 		<!--Form for adding a new secondary category of articles-->
 		<form action="workspace/cat/uploadprimary.php" method="POST" name="uploadForm" id="uploadForm" enctype="multipart/form-data">
      <div id="primary_cat">
        Primary Category
        <select id="primary_select" name="primary_select">    <!--Selection of primary category-->
<?php 

  $get_primary = $mysqli->query("SELECT cat_id, cat_name FROM primary_category");

  echo   '<option selected value="0">Select category</option>';       //Default option

  $primary_category_count = $get_primary->num_rows;           //Get number of primary categories
  while($get_primary_list = $get_primary->fetch_assoc()) {
    echo '<option value="'.$get_primary_list['cat_id'].'">'.$get_primary_list['cat_name'].'</option>';
  }
?>
        </select>
      </div>
      <input type="file" name="imageFile" id="imageFile"/> 
      <br/>
      <input name="uploadSubmit" class="button-primary" type="submit" value="Submit">
      <p style="color:red"><?php echo $error; ?></p>
	  </form>
  </div>
    <script src="scripts/jquery.js"></script>
    <script type="text/javascript">
    $('#uploadForm').submit(function() {
      var primCat = $('#primary_select').val();
      if(primCat == 0) {
        alert("Select Primary Category.");
        return false;
      }
    });
    $("input:file").change(function (){
      var fileName = $(this).val();
      $(".filename").html(fileName);
    });
    </script>
</body>
</html>
