$(document).ready(function(){ 
	var touch 	= $('#resp-menu');
	var menu 	= $('.menu');
	var res_toggle = $('.responsive-menu');
	$(touch).on('click', function(e) {
        // alert('hello');
		e.preventDefault();
		menu.slideToggle();
		res_toggle.toggleClass('menu_clicked');
	});
	
	
	// switcher
	$(".ui-switcher").click(function() {

		var lang =  $('#lang').val();
		if (lang == '0') {

			$(".ui-switcher").attr('aria-checked',true);
			$(".form-check-input").val('1');

		}else{

			$(".ui-switcher").attr('aria-checked',false);
			$(".form-check-input").val('0');
		}
	
	});

	
});

$(document).ready(function() {
	var stickyNavTop = 50;
  
	var stickyNav = function(){
	  var scrollTop = $(window).scrollTop();
  
	  if (scrollTop > stickyNavTop) { 
		$('#main_header').addClass('sticky');
	  }else {
		$('#main_header').removeClass('sticky');
	  }
	};
  
	stickyNav();
  
	$(window).scroll(function() {
	  stickyNav();
	});
});
$(document).ready(function() {
	document.onreadystatechange = function() {
		if (document.readyState === "complete") {
			$("#loader").addClass("loaded-circle");
			$("#loader-img").addClass("loaded-img");
			$("#preloader").addClass("loaded-img");
		}
	}
});

  