<?php 
	require_once('../config.php');
	require_once('../initialize_database.php');
  $error = "";
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
          chmod(UPLOAD_DIR.$name, 0644);
          header("Location: confirm.php?status=2");
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
    		<h4>Upload Malayalam PDF</h4>
    		<!--Form for adding a new category of articles-->
    		<form action="workspace/article/uploadpdf.php?article=<?php echo $_GET['article']; ?>" method="POST" name="uploadPDFForm" id="uploadPDFForm" enctype="multipart/form-data">
          <input type="file" name="malayalam_pdf"/> 
          <span class="filename">No PDF selected</span> 
          <br/>
          <input type="submit" value="Upload" name="pdfSubmit">
          <p><?php echo $error; ?></p>
	    	</form>
    	</div>
  	</div>

    <script src="scripts/jquery.js"></script>
    <script type="text/javascript">
      $(function() {
         $("input:file").change(function (){
           var fileName = $(this).val();
           $(".filename").html(fileName);
         });
      });
    </script>


</body>
</html>
