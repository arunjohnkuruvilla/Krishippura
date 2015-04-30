<?php 
	require_once('../config.php');
	require_once('../initialize_database.php');
  require_once("../authenticate.php");
  $error = "";
  $error2 = "";
  $error3 = "";
  if(isset($_POST['pdfSubmit'])) {
    $id = $_GET['article'];
    if(!empty($_FILES["malayalam_pdf"])) {

      $pdf = $_FILES["malayalam_pdf"];

      if($pdf["error"] !== UPLOAD_ERR_OK) {
        $error = "An error occured during the file upload.";
      }

      $finfo = finfo_open(FILEINFO_MIME_TYPE);
      $mime = finfo_file($finfo, $pdf['tmp_name']);
      if($mime == "application/pdf") {
        $name = $pdf['name'];

        $article_query = $mysqli->query("SELECT * FROM page WHERE page_id = '$id'");
        $article_result = $article_query->fetch_assoc();

        $name = str_replace(" ", "_", $article_result['page_title'].".pdf");

        $success = move_uploaded_file($pdf["tmp_name"], UPLOAD_DIR.$name);

        if(!$success) {
          $error = "Unable to save the file. Please try again.";
        }
        else {
          $update_status = $mysqli->query("UPDATE page SET pdf_status = 1 WHERE page_id = '$id'");
          if($update_status) {
            chmod(UPLOAD_DIR.$name, 0644);
            header("Location: confirm.php?status=2");
          }
          else {
            $error = "Error in updating database. Please try again";
          }
        }
      }
      else {
        $error = "Incorrect format of the upload";
      }
    }
    else {
      $error = "Please select a file to upload.";
    }
  }
  if(isset($_POST['pngSubmit'])) {
    $id = $_GET['article'];
    if(!empty($_FILES["malayalam_name"])) {

      $pdf = $_FILES["malayalam_name"];

      if($pdf["error"] !== UPLOAD_ERR_OK) {
        $error = "An error occured during the file upload.";
      }

      $finfo = finfo_open(FILEINFO_MIME_TYPE);
      $mime = finfo_file($finfo, $pdf['tmp_name']);
      if($mime == "image/png") {
        $name = $pdf['name'];

        $article_query = $mysqli->query("SELECT * FROM page WHERE page_id = '$id'");
        $article_result = $article_query->fetch_assoc();

        $name = str_replace(" ", "_", $article_result['page_title'].".png");

        $success = move_uploaded_file($pdf["tmp_name"], UPLOAD_PNG_DIR.$name);

        if(!$success) {
          $error2 = "Unable to save the file. Please try again.";
        }
        else {
          $update_status = $mysqli->query("UPDATE page SET name_png_status = 1 WHERE page_id = '$id'");
          if($update_status) {
            chmod(UPLOAD_PNG_DIR.$name, 0644);
            header("Location: confirm.php?status=5");
          }
          else {
            $error2 = "Error in updating database. Please try again";
          }
        }
      }
      else {
        $error2 = "Incorrect format of the upload";
      }
    }
    else {
      $error2 = "Please select a file to upload.";
    }
  }
  if(isset($_POST['jpgSubmit'])) {
    $id = $_GET['article'];
    if(!empty($_FILES["thumbnail"])) {

      $pdf = $_FILES["thumbnail"];

      if($pdf["error"] !== UPLOAD_ERR_OK) {
        $error = "An error occured during the file upload.";
      }

      $finfo = finfo_open(FILEINFO_MIME_TYPE);
      $mime = finfo_file($finfo, $pdf['tmp_name']);
      if($mime == "image/jpeg") {
        $name = $pdf['name'];

        $article_query = $mysqli->query("SELECT * FROM page WHERE page_id = '$id'");
        $article_result = $article_query->fetch_assoc();

        $name = str_replace(" ", "_", $article_result['page_title'].".jpg");

        $success = move_uploaded_file($pdf["tmp_name"], UPLOAD_THUMBNAIL_DIR.$name);

        if(!$success) {
          $error3 = "Unable to save the file. Please try again.";
        }
        else {
          $update_status = $mysqli->query("UPDATE page SET thumbnail_status = 1 WHERE page_id = '$id'");
          if($update_status) {
            chmod(UPLOAD_THUMBNAIL_DIR.$name, 0644);
            header("Location: confirm.php?status=6");
          }
          else {
            $error3 = "Error in updating database. Please try again";
          }
        }
      }
      else {
        $erro3 = "Incorrect format of the upload";
      }
    }
    else {
      $erro3 = "Please select a file to upload.";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<base href="/"/>
  	<meta charset="utf-8">
  	<title>Krishipurra</title>
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
    		<h4>Upload Malayalam PDF</h4>
    		<!--Form for adding a new category of articles-->
    		<form action="workspace/article/uploadcontents.php?article=<?php echo $_GET['article']; ?>" method="POST" name="uploadPDFForm" id="uploadPDFForm" enctype="multipart/form-data">
          <input type="file" name="malayalam_pdf" id="malayalam_pdf"/> 
          <span class="malayalam-pdf-filename">No PDF selected</span> 
          <br/>
          <input type="submit" value="Upload" name="pdfSubmit">
          <p><?php echo $error; ?></p>
	    	</form>

        <h4>Upload Malayalam Name png</h4>
        <form action="workspace/article/uploadcontents.php?article=<?php echo $_GET['article']; ?>" method="POST" name="uploadPNGForm" id="uploadPNGForm" enctype="multipart/form-data">
          <input type="file" name="malayalam_name" id="malayalam_name"/> 
          <span class="malayalam-name-filename">No PNG selected</span> 
          <br/>
          <input type="submit" value="Upload" name="pngSubmit">
          <p><?php echo $error2; ?></p>
        </form>
        <h4>Upload Thumbnail</h4>
        <form action="workspace/article/uploadcontents.php?article=<?php echo $_GET['article']; ?>" method="POST" name="uploadJPGForm" id="uploadJPGForm" enctype="multipart/form-data">
          <input type="file" name="thumbnail" id="thumbnail"/> 
          <span class="thumbnail-filename">No JPG selected</span> 
          <br/>
          <input type="submit" value="Upload" name="jpgSubmit">
          <p><?php echo $error3; ?></p>
        </form>
    	</div>
  	</div>

    <script src="scripts/jquery.js"></script>
    <script type="text/javascript">
      $(function() {
        $("#thumbnail").change(function (){
          var fileName = $(this).val();
          $(".thumbnail-filename").html(fileName);
        });
        $("#malayalam_name").change(function (){
          var fileName = $(this).val();
          $(".malayalam-name-filename").html(fileName);
        });
        $("#malayalam_pdf").change(function (){
          var fileName = $(this).val();
          $(".malayalam-pdf-filename").html(fileName);
        });
      });
    </script>


</body>
</html>
