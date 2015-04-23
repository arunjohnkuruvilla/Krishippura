<!DOCTYPE html>
<html lang="en">
<head>
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
  <!-- Navigation Bar -->
  <?php require("./includes/layout/navbar.php") ?>

  <div style="height:100%;width:100%;background-image:url('images/background.jpg');background-size:100%"></div>
  <!--<div style="height:50%;width:100%;background-color:rgba(0,0,0,0.2)">
    <div class="container" style="padding-top:5rem">
      <!--Search Function
      <div id="query-section" class="row" style="height:20em;padding:2em">
        <div class="twelve columns">
          <form name="searchForm" id="searchForm">
            <div class="six columns">
              <input type="text" placeholder="Start searching..." id="searchInput" class="nine columns"  style="margin-right:1%">
              <input name="searchSubmit" class="button-primary" type="submit" value="Submit">
            </div>
            <div class="button three columns" id="advance_trigger">Advanced Options</div>

            <br/>
            <div id="advanced" style="display:none" class="twelve columns">
              <div id="primary_cat" class="three columns" style="margin-left:0"></div>
              <div id="secondary_cat" class="three columns" style="margin-left:0"></div>
            </div>
            
          </form>
        </div>
        <!--Search results
          <div id="search_results" class="twelve columns" style="display:none;z-index:999"></div>
      </div>
    </div>
  </div>-->
  <div class="" style="width:100%;height:50%;background-color:rgba(0,0,0,0.2);padding:10%">
      <div id="morphsearch" class="morphsearch" style="margin-left: auto;margin-right: auto">
        <form class="morphsearch-form" id="searchForm">
          <input class="morphsearch-input" type="search" placeholder="Search..." id="searchInput"/>
          <input class="morphsearch-submit" type="submit" id="searchSubmit"/>
          <div class="twelve columns">
            <div class="button three columns advanced_trig" id="advanced_trigger">Advanced Options</div>
          </div>

          <div id="advanced" class="advanced">
            <div id="primary_cat" class="three columns" style="margin-left:0;margin-top:10px"></div>
            <div id="secondary_cat" class="three columns" style="margin-left:10px;margin-top:10px"></div>
          </div>
        </form>
        <div class="morphsearch-content">
          <div id="search_results" class="twelve columns" style="z-index:999;height:50%">
            
          </div>
        </div><!-- /morphsearch-content -->
        <span class="morphsearch-close"></span>
      </div><!-- /morphsearch -->
      <div class="overlay"></div>
    </div><!-- /container -->
  <div style="width:100%;padding:5%">
    <div class="container" style="overflow:auto">
      <div class="grid">
          <div id="primary"></div>
        </div>
    </div>
  </div>
  <div style="height:10%;width:100%;background-color:rgba(0,0,0,0.2)"></div>
  

  <script type="text/javascript" src="scripts/jquery.js"></script>
  <script type="text/javascript" src="scripts/main.js"></script>
  <script type="text/javascript" src="scripts/classie.js"></script>
  <script>
      (function() {
        var morphSearch = document.getElementById( 'morphsearch' ),
          input = morphSearch.querySelector( 'input.morphsearch-input' ),
          ctrlClose = morphSearch.querySelector( 'span.morphsearch-close' ),
          isOpen = isAnimating = false,
          // show/hide search area
          toggleSearch = function(evt) {
            // return if open and the input gets focused
            if( evt.type.toLowerCase() === 'focus' && isOpen ) return false;

            var offsets = morphsearch.getBoundingClientRect();
            if( isOpen ) {
              classie.remove( morphSearch, 'open' );

              // trick to hide input text once the search overlay closes 
              // todo: hardcoded times, should be done after transition ends
              if( input.value !== '' ) {
                setTimeout(function() {
                  classie.add( morphSearch, 'hideInput' );
                  setTimeout(function() {
                    classie.remove( morphSearch, 'hideInput' );
                    input.value = '';
                  }, 300 );
                }, 500);
              }
              
              input.blur();
            }
            else {
              classie.add( morphSearch, 'open' );
            }
            isOpen = !isOpen;
          };

        // events
        input.addEventListener( 'focus', toggleSearch );
        ctrlClose.addEventListener( 'click', toggleSearch );
        // esc key closes search overlay
        // keyboard navigation events
        document.addEventListener( 'keydown', function( ev ) {
          var keyCode = ev.keyCode || ev.which;
          if( keyCode === 27 && isOpen ) {
            toggleSearch(ev);
          }
        } );


        /***** for demo purposes only: don't allow to submit the form *****/
        morphSearch.querySelector( 'button[type="submit"]' ).addEventListener( 'click', function(ev) { ev.preventDefault(); } );
      })();
    </script>
</body>
</html>
