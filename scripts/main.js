var advancedStatus = false;
var isOpen = isAnimating = false;
$('#advanced_trigger').click(function() {
  if(advancedStatus) {
    $('#primary_select').val('0');
    if ($('#secondary_select').length > 0) {
      $('#secondary_select').val('0');
    }
    $('#advanced').slideUp("slow");
    advancedStatus = false;
  }
  else {
    $('#advanced').slideDown("slow");
    advancedStatus = true;
  }
});

$('.morphsearch-close').click(function() {
  $('#advanced').slideUp("fast");
  advancedStatus = false;
});
$(document).keyup(function(e) {
  if (e.keyCode == 27) { 
    $('#advanced').slideUp("fast");
    advancedStatus = false;
  }   // escape key maps to keycode `27`
});

//to populate the primary categories
$.ajax({
   type: 'GET',
   url: "api/primary.php",
   async: false,
   contentType: "application/json",
   dataType: 'json',
   success: function(data) {
      var i;
      var menuContent = "";
      var selectionContent = '<select id="primary_select" name="primary_select">';
      selectionContent += '<option value="0">Select primary category</option>'
      for(i = 0; i < data.length; i++) {
         menuContent += '<figure class="effect-honey">';
         menuContent += '<img src="images/primary/' + data[i]['image'] + '.jpg" alt="img04"/>';
         menuContent += '<figcaption>';
         menuContent += '<h2>'+ data[i]['name'] +'</h2>';
         menuContent += '<a href="'+ data[i]['link'] +'">View more</a>';
         menuContent += '</figcaption>';
         menuContent += '</figure>';
         if(i == 2) continue;
         selectionContent += '<option value="'+ data[i]['id'] +'">'+ data[i]['name'] +'</option>';
      }
      selectionContent += '</select>';
      $('#primary_cat').html(selectionContent);
      $('#primary').html(menuContent);
   },
   error: function(jqXHR, textStatus) {
      alert("Please check your internet connection");
   }
});

//Searching
$('#searchForm').submit(function() {
   if(!isOpen) return false;
   var searchQuery = $('#searchInput').val();
   var primCat = $('#primary_select').val();
   if(searchQuery == "") {
      alert("Please enter search query.");
      return false;
   }
   var regx = /^[A-Za-z0-9 ]+$/;
   if (!regx.test(searchQuery)) {
      alert("Only alphabets and numbers allowed");
      return false;
   }
   if(primCat == 0) {
      var source = 'api/search.php?query=' + searchQuery;
   }
   else {
      var secCat = $('#secondary_select').val();
      if(secCat == 0) {
         var source = 'api/search.php?query=' + searchQuery + "&primary=" + primCat + "&secondary=0";
      }
      else {
         var source = 'api/search.php?query=' + searchQuery + "&primary=" + primCat + "&secondary=" + secCat;
      }
   }
   $.ajax({
      type: 'GET',
      url: source,
      async: false,
      contentType: "application/json",
      dataType: 'json',
      success: function (data) {
         var i;
         var content = "<div>";
         if(data[0]['title'] <= 0) {
           content += '<div class="result-item">';
           content += "<h3>" + data[0].content + "</h3></div>";
         }
         else {
           for(i=0; i < data.length; i++) {
             content += '<div class="result-item"><h3><a href="articles/'+ data[i].link + '">' + data[i].title + '</a></h3>';
             content += "<p>" + data[i].content + "</p></div>";
           }
         }
          
         $('#search_results').html(content);
         $('#search_results').slideDown("slow");
      },
      error: function (jqXHR, textStatus) {
         alert(textStatus);
      }
   });
   return false;
});


var data = (function() {
    var json = null;
    $.ajax({
      type: 'GET',
      url: 'api/secondary.php ',
      async: false,
      contentType: "application/json",
      dataType: 'json',
      success: function (data) {
        json = data;
      },
      error: function (jqXHR, textStatus) {
        alert(textStatus);
      }
    });
    return json;
  })();  
//Populating the secondary dropdown based on the primary selected value
$("#primary_select").change(function() {
  /*  JSON array fetched from the API*/
  var index = $('#primary_select').val() - 1;
  $("select option:selected").each(function() {
    //alert($('#primary_select').val());
    if(index == -1) {
      return false;
    }
    var j = data[index].length;
    var i;
    var content = "";                 //Content for the secondary category dropdown
    content += '<select id="secondary_select" name="secondary_select"><option selected value="0">Select Secondary category</option>';
    for(i = 0; i < j; i++) {
      content += '<option value="' + data[index][i]['id'] + '">' + data[index][i]['name'] + '</option>';
    }
    content += '</select>';
    $('#secondary_cat').html("");           //Clearing the secondary category content
    $('#secondary_cat').append(content);        //Adding secondary category dropdown*/
  });
}).trigger( "change" );

(function() {
   var morphSearch = document.getElementById( 'morphsearch' ),
   input = morphSearch.querySelector( 'input.morphsearch-input' ),
   ctrlClose = morphSearch.querySelector( 'span.morphsearch-close' ),
   
   // show/hide search area
   toggleSearch = function(evt) {
      // return if open and the input gets focused
      input.focus();
      if( evt.type.toLowerCase() === 'focus' && isOpen ) return false;

      //var offsets = morphsearch.getBoundingClientRect();
      if( isOpen ) {
         classie.remove( morphSearch, 'open' );

         // trick to hide input text once the search overlay closes 
         /* todo: hardcoded times, should be done after transition ends
         /^if( input.value !== '' ) {
            setTimeout(function() {
               classie.add( morphSearch, 'hideInput' );
               input.focus();
               setTimeout(function() {
                  classie.remove( morphSearch, 'hideInput' );
                  input.value = '';
               }, 300 );
            }, 500);
         }*/
         input.blur();
      }
      else {
         classie.add( morphSearch, 'open' );
         input.focus();
      }
      isOpen = !isOpen;
   };

   // events
   input.addEventListener( 'focus', toggleSearch );
   ctrlClose.addEventListener( 'click', toggleSearch );
   //document.getElementById('searchSubmit').addEventListener('click', toggleSearch );
   // esc key closes search overlay
   // keyboard navigation events
   document.addEventListener( 'keydown', function( ev ) {
      var keyCode = ev.keyCode || ev.which;
      if( keyCode === 27 && isOpen ) {
         toggleSearch(ev);
      }
   });


   /***** for demo purposes only: don't allow to submit the form *****/
      //document.getElementById('searchSubmit').addEventListener( 'click', function(ev) { ev.preventDefault(); } );
})();

$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});