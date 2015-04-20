$('#advance_trigger').click(function() {
  $('#advanced').slideToggle("slow");
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
      menuContent += '<a href="' + data[i]['link'] + '">';
      menuContent += '<div id="' + data[i]['name'] + '-section" class="row" style="height:20em;background:url(./images/primary/'+ data[i]['image'] +'.jpg)">';
      menuContent += '<h2 style="padding:1em;">' + data[i]['name'] + '</h2>';
      menuContent += '</div>';
      menuContent += '</a>';

      selectionContent += '<option value="'+ data[i]['id'] +'">'+ data[i]['name'] +'</option>';
    }
    selectionContent += '</select>';
    $('#primary_cat').html(selectionContent);
    $('#primary').html(menuContent);
  },
  error: function(jqXHR, textStatus) {
    alert(textStatus);
  }
});

$('#searchForm').submit(function() {
  var searchQuery = $('#searchInput').val();
  var primCat = $('#primary_select').val();

  if(searchQuery == "") {
    alert("Please enter search query.");
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
      var content = "<ul>";
      if(data[0]['title'] <= 0) {
        content += "<li>";
        content += "<h6>" + data[0].content + "</h6>";
        content += "</li>";
      }
      else {
        for(i=0; i < data.length; i++) {
          content += "<li>";
          content += '<h6><a href="articles/'+ data[i].link + '">' + data[i].title + '</a></h6>';
          content += "<p>" + data[i].content + "</p>";
          content += "</li>";
        }
      }
       
      $('#search_results').html(content);
      $('#search_results').slideToggle("slow");
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

