<!DOCTYPE html>
<html>
<head>
	<base href="/"/>
  	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />

  	<title>Article Preview</title>
  	<link rel="stylesheet" href="css/normalize.css">
  	<link rel="stylesheet" href="css/skeleton.css">
  	<link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" type="text/css" href="css/article.css">

<body>

    <!-- Navigation Bar -->
    <?php require("./includes/layout/navbar.php") ?>

    <div id="main_content" class="container" style="padding-top:5rem;padding-bottom:4rem;height:95%"></div>


    <script src="scripts/jquery.js"></script>
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
        var tabindex;
        var contents;
        var navbuttons = "";
        var i = 1;

        $.ajax({
          type: 'GET',
          url: source,
          async: false,
          contentType: "application/json",
          dataType: 'json',
          success: function (data) {
            var container = $("#main_content");
            container.append("<h2>"+data['title']+"</h2>");

            if(data['pdf']) {
              container.append('<a href="pdf/'+ first +'.pdf" target="_blank">Click here to read the article in Malayalam</a><br/>');
            }
            for ( i = 1; i < data['sections_count']; i++) {
              tabindex = "tab"+(i+1);
              navbuttons += '<a class="button article_nav" style="width:auto" href="articles/'+first+'#'+tabindex+'">' + data['section_head'][i] + '</a>';
            };
            navbuttons += '<br/><br/><br/><br/>';
            container.append(navbuttons);
            i=1;
            tabindex = "tab"+i;
            contents = '<div class="tab_section_intro">';
            contents += '<div class="tab_section_intro_content"><p>' + data[tabindex][1] + '</p></div>';
            contents += '</div>';
            container.append(contents);

            for (i = 2; i <= data['sections_count']; i++) {
              tabindex = "tab"+i;
              contents = '<div id="'+tabindex+'" class="tab_section">';
              contents += '<div class="tab_section_head"><p>' + data[tabindex][0] + '</p></div>';
              contents += '<div class="tab_section_content"><p>' + data[tabindex][1] + '</p></div>';
              contents += '</div>';
              container.append(contents);
            }
          },
          error: function (jqXHR, textStatus) {
            alert(textStatus);
          }
        });
      $('.section_drop').click(function() {
        $(this).parent().parent().children().slideDown();
      });
    });
    </script>
</body>
</html>
