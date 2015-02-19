<!DOCTYPE html>
<html>
<head>
	<base href="/"/>
  	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />

  	<title>Article Preview</title>
  	<link rel="stylesheet" href="css/normalize.css">
  	<link rel="stylesheet" href="css/skeleton.css">
  	<link rel="stylesheet" href="css/custom.css">

<body>

    <!-- Navigation Bar -->
    <?php require("./includes/layout/navbar.php") ?>

    <div class="container" style="padding-top:5rem;padding-bottom:4rem;height:95%">

    </div>
    <footer class="footer">
	    <div class="container">
	    Copyright. All rights reserved.   
	    </div>
  	</footer>
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript">
          function getUrlVars() {
          var vars = {};
          var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
              vars[key] = value;
          });
          return vars;
      }
      $(document).ready(function() {
        var pathArray = window.location.pathname.split( '/' );
        var first = pathArray[2];
        var source = "/api/content.php?page=" + first;
        $.ajax({
          type: 'GET',
          url: source,
          async: false,
          contentType: "application/json",
          dataType: 'json',
          success: function (data) {
            alert("here is the title: "+data['a']+" .Use it how you want!");
          },
          error: function (jqXHR, textStatus) {
            alert(textStatus);
          }
        });
        alert(first);
    });
    </script>
</body>
</html>
