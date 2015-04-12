<?php
// this is where content is entered for the appropriate event using an HTML editor.
// content from the database will be filled in hidden text boxes and then populated to sections and other
require_once('../config.php');
require_once("../initialize_database.php");
$eventcode = "";
/*if (isset($_SESSION["type"])) {
  // only accessible to managers and proofreaders
  if ($_SESSION["type"] == 'MN' || $_SESSION["type"] == 'PR') {
    if (isset($_SESSION["ecode"]))
      $eventcode = $_SESSION["ecode"];
    else // event code not set!
      _exit("Please go back and try again!");
  } else
    _exit("You don't have permission!");
} else {
  header("Location: $start_page");
  _exit();
}*/

$eventcode = $_GET['article'];

// get the content from the database
$query="SELECT page_id,page_title,page_creator,page_content FROM page WHERE page_id='$eventcode'";
$result=$mysqli->query($query);
$row=$result->fetch_assoc();
if($row)
{
    $page_name=$row['page_title'];
    $content=$row['page_content'];
    $result->free();
}
$mysqli->close();
?>
<!DOCTYPE html>

<html>
<head>
  <base href="/" />
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />

  <title>Article Editor</title>
  <link rel="stylesheet" type="text/css" media="all" href="css/manager.css"/>
  <link rel="stylesheet" type="text/css" media="all" href="css/normalize.css">
  <link rel="stylesheet" type="text/css" media="all" href="css/skeleton.css">
  <link rel="stylesheet" type="text/css" media="all" href="css/custom.css">

  <script type="text/javascript" src="scripts/jquery.min.js"></script>
  <script type="text/javascript" src="scripts/ajaxupload.js"></script>
  <script type="text/javascript" src="scripts/kaja-input.js"></script>
  <script type="text/javascript" src="scripts/editor.js"></script>

</head>

<body>

    <!-- Navigation Bar -->
    <?php include("../../includes/layout/navbar.php") ?>

    <div class="container" style="padding-top:5rem;padding-bottom:4rem;height:95%">
        <!-- If proofreader then 'Go back' option is present so as to allow the proofreader
            to go back and switch the event content to proofread--> 
    	   Article ID: <b><?php echo $eventcode; ?></b>
         <br/>
         Article Title: <b><?php echo $page_name; ?></b>
        <form method="post" action="<?php echo $article_link; ?>preview.php?article=<?php echo $eventcode;?>" id="event_form" name="event_form">
          
          <br/>
          <br/>
          

          <!-- This hidden text is where the longdesc from the database is populated.-->
          <!-- This content is then split and populated into various sections by creating them dynamically-->  
          <!-- All of which is done using Jquery and Javascript-->    
          <input type="hidden" id="desc" name="content" value="<?php echo str_replace('"', '&quot;', $content);?>" />

            <!-- update button -->
            <input name="update" type="submit" value="Update" />
            <input name="cancel_changes" type="submit" value="Discard Changes" />
        </form>
        <div class="row">
            <div class="main">
                <h5>Introduction</h5>
                <textarea id="intro" name="intro"></textarea>
                <!-- button for adding new sections -->  
                <a href="javascript:void(0)" id="new_sec" class="button">Add a Section</a>
                <a href="#" class="button">Go to Top</a>
            </div>
        </div>
    </div>
</body>
</html>
