$(function () {

  $('img.lazy').jail();

  $('#search_input').bind("enterKey",function(e){
    
    if($('#search_input').val()!=""){
      window.location.replace(CI.base_url+'search/all/'+$.trim($('#search_input').val()).replace(' ','-'));
    }

  });
  $('#search_input').keyup(function(e){
    if(e.keyCode == 13)
    {
      $(this).trigger("enterKey");
    }
  });

  // sidebar menu dropdown toggle
  $("#dashboard-menu .dropdown-toggle").click(function (e) {
    e.preventDefault();
    var $item = $(this).parent();
    $item.toggleClass("active");
    if ($item.hasClass("active")) {
      $item.find(".submenu").slideDown("fast");
    } else {
      $item.find(".submenu").slideUp("fast");
    }
  });


  // mobile side-menu slide toggler
  var $menu = $("#sidebar-nav");
  $("body").click(function () {
    if ($menu.hasClass("display")) {
      $menu.removeClass("display");
    }
  });
  $menu.click(function(e) {
    e.stopPropagation();
  });
  $("#menu-toggler").click(function (e) {
    e.stopPropagation();    
    $menu.toggleClass("display");    
  });  

  $('.link').tooltip()

	// build all tooltips from data-attributes
	$("[data-toggle='tooltip']").each(function (index, el) {
		$(el).tooltip({
			placement: $(this).data("placement") || 'top'
		});
	});


  // custom uiDropdown element, example can be seen in user-list.html on the 'Filter users' button
  var uiDropdown = new function() {
  	var self;
  	self = this;
  	this.hideDialog = function($el) {
      return $el.find(".dialog").hide().removeClass("is-visible");
    };
    this.showDialog = function($el) {
      return $el.find(".dialog").show().addClass("is-visible");
    };
    return this.initialize = function() {
      $("html").click(function() {
        $(".ui-dropdown .head").removeClass("active");
        return self.hideDialog($(".ui-dropdown"));
      });
      $(".ui-dropdown .body").click(function(e) {
        return e.stopPropagation();
      });
      return $(".ui-dropdown").each(function(index, el) {
        return $(el).click(function(e) {
         e.stopPropagation();
         $(el).find(".head").toggleClass("active");
         if ($(el).find(".head").hasClass("active")) {
           return self.showDialog($(el));
         } else {
           return self.hideDialog($(el));
         }
       });
      });
    };
  };

    // instantiate new uiDropdown from above to build the plugins
    new uiDropdown();


  	// toggle all checkboxes from a table when header checkbox is clicked
  	$(".table th input:checkbox").click(function () {
  		$checks = $(this).closest(".table").find("tbody input:checkbox");
  		if ($(this).is(":checked")) {
  			$checks.prop("checked", true);
  		} else {
  			$checks.prop("checked", false);
  		}  		
  	});


  });