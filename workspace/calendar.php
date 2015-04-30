<?php 
    require_once('./config.php');
    require_once("./initialize_database.php");
    require_once("./authenticate.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/">
    <meta charset="utf-8">
    <title>Krishipurra</title>
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
    <style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:auto;word-wrap: break-word;word-break:normal;}
    .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;word-break:normal;}
    .tg .tg-s6z2{text-align:center;padding: 0}
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <?php include("../includes/layout/navbar.php") ?>

    <div class="container" style="padding-top:5em">
        <div class="twelve columns">
            <h5>
                <?php 
                    if(isset($_GET['newtable'])) {
                        if($_GET['newtable'] == 1) {
                            echo "New table added successfully";
                        }
                    }
                    if(isset($_GET['deletetable'])) {
                        if($_GET['deletetable'] == 1) {
                            echo "Table deleted successfully";
                        }
                    }
                    if(isset($_GET['deleterow'])) {
                        if($_GET['deleterow'] == 1) {
                            echo "Row deleted successfully";
                        }
                    }
                    if(isset($_GET['renametable'])) {
                        if($_GET['renametable'] == 1) {
                            echo "Table renamed successfully";
                        }
                    }
                ?>
                </h5>
            <form class="six columns" method="POST" action="workspace/calendar/addnewtable.php" id="newTableForm">
                <input type="text" name="newTableName" id="newTableName" placeholder="Enter new table name" />
                <input type="submit" class="button" href="./workspace/calendar/addnewtable.php" value="Create new table" name="newTableSubmit" id="newTableSubmit">
                
            </form>
        </div>
        

        <?php 
        $table_query = $mysqli->query("SELECT * FROM calendar_tables");
        while($table = $table_query->fetch_assoc()) {
            echo '
            <h3 class="">'.$table['name'].'</h3>
            <a class="button" style="width: 20%" href="./workspace/calendar/renametable.php?table='.$table['id'].'">Rename Table</a>
            <a class="button" style="width: 20%" href="./workspace/calendar/deletetable.php?table='.$table['id'].'">Delete Table</a>
            <br/>
            <br/>
            <table class="tg" style="undefined;table-layout: fixed; width: 100%">
                <colgroup>
                    <col style="width: 10%">
                    <col style="width: 10%">
                    <col style="width: 10">
                    <col style="width: 10%">
                    <col style="width: 10%">
                    <col style="width: 10%">
                    <col style="width: 10%">
                    <col style="width: 10%">
                    <col style="width: 10%">
                    <col style="width: 10%">
                </colgroup>
                <tr>
                    <th class="tg-s6z2"></th>
                    <th class="tg-s6z2">Name of Crop</th>
                    <th class="tg-s6z2">Time and Season</th>
                    <th class="tg-s6z2">Seeds (g)</th>
                    <th class="tg-s6z2">Gap between seeds (cm)</th>
                    <th class="tg-s6z2">Depth (cm)</th>
                    <th class="tg-s6z2">Sapling Density</th>
                    <th class="tg-s6z2">Produce (kg)</th>
                    <th class="tg-s6z2"></th>
                    <th class="tg-s6z2"></th>
                </tr>'; 
            $table_id = $table['id'];
            $table_row_query = $mysqli->query("SELECT * FROM `calendar` WHERE `table` = '$table_id'");
            while($table_row = $table_row_query->fetch_assoc()) {
                echo '
                <tr>
                    <td class="tg-s6z2">'.$table_row['table'].'</td>
                    <td class="tg-s6z2">'.$table_row['column1'].'</td>
                    <td class="tg-s6z2">'.$table_row['column2'].'</td>
                    <td class="tg-s6z2">'.$table_row['column3'].'</td>
                    <td class="tg-s6z2">'.$table_row['column4'].'</td>
                    <td class="tg-s6z2">'.$table_row['column5'].'</td>
                    <td class="tg-s6z2">'.$table_row['column6'].'</td>
                    <td class="tg-s6z2">'.$table_row['column7'].'</td>
                    <td class="tg-s6z2"><a class="button" href="./workspace/calendar/editrow.php?id='.$table_row['id'].'">EDIT</a></td>
                    <td class="tg-s6z2"><a class="button" href="./workspace/calendar/deleterow.php?id='.$table_row['id'].'">DELETE</a></td>
                </tr>'; 
            }
            echo '</table>
            <a class="button" href="./workspace/calendar/addnewrow.php?table='.$table['id'].'">Add a new row</a><br/><br/><br/>';
        }
        ?>
        
        
    <script type="text/javascript" src="scripts/jquery.js"></script>
    <script type="text/javascript">
    $("#newTableForm").submit(function() {
        var newtable = $("#newTableName").val();
        if(newtable == "") {
            alert("Please enter new table's name");
            return false;
        }
    });
    </script>
</body>
</html>
