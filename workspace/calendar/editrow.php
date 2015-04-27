<?php 
    require_once('../config.php');
    require_once("../initialize_database.php");
    require_once("../authenticate.php");
    $error = "";
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    else if (isset($_POST['editRowSubmit'])) {
        $id = htmlspecialchars($_POST['id']);
        $column1 = htmlspecialchars($_POST['column1Input']);
        $column2 = htmlspecialchars($_POST['column2Input']);
        $column3 = htmlspecialchars($_POST['column3Input']);
        $column4 = htmlspecialchars($_POST['column4Input']);
        $column5 = htmlspecialchars($_POST['column5Input']);
        $column6 = htmlspecialchars($_POST['column6Input']);
        $column7 = htmlspecialchars($_POST['column7Input']);
        $update_row = $mysqli->query("UPDATE `calendar` SET `column1` = '$column1', `column2` = '$column2', `column3` = '$column3', `column4` = '$column4', `column5` = '$column5', `column6` = '$column6', `column7` = '$column7' WHERE `id` = '$id'");
        if($update_row) {
            header("Location: ../calendar.php");
        }
        else {
            $error = "Update failed";
        }
    }
    else {
        header("Location: ../calendar.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <base href="/">
    <meta charset="utf-8">
    <title>AgroDB</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- FONT -->
    <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>

    <!-- CSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <link rel="stylesheet" href="css/custom.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="">

</head>
<body>
    <!-- Navigation Bar -->
    <?php include("../layout/navbar.php") ?>

    <div class="container" style="padding-top:5em">
        <h4><?php echo $error?></h4>
        <form id="rowEditForm" name="rowEditForm" method="POST" action="./workspace/calendar/editrow.php">
          <div class="row">
          <?php 
            $row_query = $mysqli->query("SELECT * FROM calendar WHERE id='$id'");
            $row = $row_query->fetch_assoc();
            echo '<input type="hidden" value="'.$row['id'].'" name="id"/>';
            echo '
                <div class="twelve columns">
                    <label for="exampleEmailInput">Your email</label>
                    <input class="u-full-width" type="text" value="'.$row['column1'].'" id="column1Input" name="column1Input">
                </div>';
            echo '
                <div class="twelve columns">
                    <label for="exampleEmailInput">Your email</label>
                    <input class="u-full-width" type="text" value="'.$row['column2'].'" id="column2Input" name="column2Input">
                </div>';
            echo '
                <div class="twelve columns">
                    <label for="exampleEmailInput">Your email</label>
                    <input class="u-full-width" type="text" value="'.$row['column3'].'" id="column3Input" name="column3Input">
                </div>';
            echo '
                <div class="twelve columns">
                    <label for="exampleEmailInput">Your email</label>
                    <input class="u-full-width" type="text" value="'.$row['column4'].'" id="column4Input" name="column4Input">
                </div>';
            echo '
                <div class="twelve columns">
                    <label for="exampleEmailInput">Your email</label>
                    <input class="u-full-width" type="text" value="'.$row['column5'].'" id="column5Input" name="column5Input">
                </div>';
            echo '
                <div class="twelve columns">
                    <label for="exampleEmailInput">Your email</label>
                    <input class="u-full-width" type="text" value="'.$row['column6'].'" id="column6Input" name="column6Input">
                </div>';
            echo '
                <div class="twelve columns">
                    <label for="exampleEmailInput">Your email</label>
                    <input class="u-full-width" type="text" value="'.$row['column7'].'" id="column7Input" name="column7Input">
                </div>';
          ?>
            
          <input class="button-primary" type="submit" value="Submit" name="editRowSubmit">
        </form>
        </div>
    <script type="text/javascript" src="scripts/jquery.js"></script>
    <script type="text/javascript">
    
    $("#rowEditForm").submit(function() {
        var column1 = $("#column1Input").val();
        var column2 = $("#column2Input").val();
        var column3 = $("#column3Input").val();
        var column4 = $("#column4Input").val();
        var column5 = $("#column5Input").val();
        var column6 = $("#column6Input").val();
        var column7 = $("#column7Input").val();
        if((column1 == "") || (column2 == "") || (column3 == "") || (column4 == "") || (column5 == "") || (column6 == "") || (column7 == "")) {
            alert("Fill all fields please.");
            return false;
        }
    });
    
    </script>
</body>
</html>

