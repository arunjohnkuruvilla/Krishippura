// remove a section
function remove_sec() {
    $(this).remove();
}

// move a section up
function move_sec_up() {
    var next = $(this).next('.desc-sec');
    var mover = $(this).prev('.desc-sec');
    if (next.length == 0 || mover.offset().top + $(this).height() > $(document).scrollTop() + $(window).height() - 200) $('body,html').animate({
        scrollTop: '+=' + $(this).height()
    }, 400);
    $(this).insertBefore(mover);
    $(this).animate({
        height: 'show',
        opacity: 'show'
    }, 400);
}

// move a section down
function move_sec_down() {
    $(this).insertAfter($(this).next('.desc-sec'));
    $(this).animate({
        height: 'show',
        opacity: 'show'
    }, 400);
}

// get (parent) section in which the DOM object 'e' is in
function get_par_sec(e) {
    return $(e).closest(".desc-sec");
}

// create and add a new section at the bottom (right before the element with id 'new_sec')
function new_desc_sec(title, content) {
    var link = $("#new_sec");
    var new_section = $("<div/>", {
        class: "desc-sec"
    });
    var desc_head = $("<span/>", {
        html: "Section Title: ",
        class: "desc-head"
    });
    var sec_ttl = $("<input type='text' />").appendTo(desc_head); //$(..).attr({name: 'xyz'})

    // dynamically creating buttons: Remove, Down, Up
    $("<span/>", {
        html: "Remove",
        class: "desc-but"
    }).click(function () {
        get_par_sec(this).hide(400, remove_sec);
    }).appendTo(desc_head);
    $("<span/>", {
        html: "Down",
        class: "desc-but"
    }).appendTo(desc_head).click(function () {
        var par_sec = get_par_sec(this);
        par_sec.next('.desc-sec').animate({
            height: 'hide',
            opacity: 'hide'
        }, 400, move_sec_up);
    });
    $("<span/>", {
        html: "Up",
        class: "desc-but"
    }).appendTo(desc_head).click(function () {
        var par_sec = get_par_sec(this);
        par_sec.prev('.desc-sec').animate({
            height: 'hide',
            opacity: 'hide'
        }, 400, move_sec_down);
    });

    //dynamically creating textarea
    var desc_src = document.createElement("textarea");
    new_section.hide();
    new_section.insertBefore(link);
    desc_head.appendTo(new_section);
    $(desc_src).appendTo(new_section);

    //calling new kaja input to make a new section
    new_kaja_input(desc_src);

    // scrolling down to shift view to the newly added section
    $('body,html').animate({
        scrollTop: '+=' + new_section.height()
    }, 400);
    new_section.show(400);
    if (title) {
        sec_ttl.val(title);
        if (content) {
            desc_src.value = content;
            update_preview(desc_src);
        }
    } else sec_ttl.focus();
}

$(document).ready(function () {

    // creating the intro section which is the default section  
    new_kaja_input($("#intro"));
    $("#new_sec").click(function () {
        new_desc_sec();
    });
    
    $("#event_form").submit(function () {
        var desc_hid = $("#desc").get(0);
        desc_hid.value = $("#intro").val();
        $(".desc-sec").each(function(index) {
            $("#desc").get(0).value += "||sec||" + $(this).find("input").val() + "||ttl||" + $(this).find("textarea").val();
        });
        desc_hid.value = desc_hid.value.replace(/'/g, "&#39;").replace(/\u2013/g, "&#8211;");
        //var articleName = $("#articleName").html();
        //articleName = articleName.replace(" ","_");
        var desc = $("#desc").get(0).value;
        /*var res = desc.match(/\[\[(.+?)\]\]/g);
        for (var i = 0; i < res.length; i++) {
          res[i] = res[i].substring(2,res[i].length-2);
          link = res[i].replace(" ","_");
          res[i] = '<a href="articles/'+link+'">'+res[i]+'</a>';
            desc = desc.replace(/\[\[(.+?)\]\]/, res[i]);
         }; */

         $("#desc").get(0).value = desc;


        //desc.value = desc.value.replace(/\[\[(.+?)\]\]/, '<a href="articles/$1">$1</a>');
        return true;
    });

    // format: <title>||ttl||<body>||sec||<title>||ttl||<body>||sec||
    // #desc contains complete event description, divided into sections using separator ||sec||
    var desc = $("#desc").get(0).value;
    /*res = desc.match(/<a href="articles\/(.+?)">(.+?)<\/a>/g);
    if(res) {
        for (var i = 0; i < res.length; i++) {
          res[i] = res[i].replace(/<a href="articles\/(.+?)">(.+?)<\/a>/,'\[\[$2\]\]');
          desc = desc.replace(/<a href="articles\/(.+?)">(.+?)<\/a>/,res[i]);
        }
    }*/
    //desc = desc.replace(/<a href="articles\/(.+?)">(.+?)<\/a>/,'\[\[$2\]\]');
    var descs = desc.split("||sec||");
    if (descs.length > 0) {
        update_preview($("#intro").val(descs[0]).get(0));
        if (descs.length > 1) {
            var sec_data, i;
            for (i = 1; i<descs.length; i++) {
            sec_data = descs[i].split("||ttl||"); // section: "<title>||ttl||<body>"
            new_desc_sec(sec_data[0], sec_data[1]);
            }
        }
    }
});
  //-->
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