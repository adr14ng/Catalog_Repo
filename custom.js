$( document ).ready(function() {
    console.log( "Custom JS is active");

    $( "#menuicon" ).click(function() {
    	console.log( "You Clicked it");
  		$( "#csunnav" ).toggleClass( "hideme" );
		if(!$( "#search-div" ).is(".hideme"))
			$( "#search-div" ).toggleClass( "hideme" );
	});
		
	$( "#searchicon" ).click(function() {
    	console.log( "You Clicked it");
  		$( "#search-div" ).toggleClass( "hideme" );
		if(!$( "#csunnav" ).is(".hideme"))
			$( "#csunnav" ).toggleClass( "hideme" );
	});


	$(".dept-container").columnize({ width: 300 });
	$(".a-z-container").columnize({ width: 400 });

	$('[data-toggle="popover"]').popover();
	
	$("h2.section-header").wrap('<span class="section-title"><span></span></span>');
	
	$('h3+table').each(function(){
		$(this).prev('h3').andSelf().wrapAll('<div class ="no-break" />');
	});
	
	$('a.pop-up').click(function(e) {
		e.preventDefault();
		var width = $("#wrap").width() / 2;
		if(width < 350)
			width = 350;
		var height = $(window).height() * 2 / 3;
		var theWindow = window.open($(this).attr('href'), 
			$(this).attr('name'), 
			'location=1, toolbar=1, scrollbars=1, resizable=1, width='+width+', height='+height);
		theWindow.focus();
	});
	
	$('a.single-ge-handle').click(function(e) {
		if (!(e.which > 1 || e.shiftKey || e.altKey || e.metaKey || e.ctrlKey)) {
			e.preventDefault();
			var item = $(this).attr('id');
			item = "#content-"+item.substring(5);
			$(item).collapse('toggle');
		}
	});
	
	$('#to_top').affix({
	  offset: {
		top: function() {
			var height = 0;
			height += $("#fixbar").outerHeight(true);
			height += $("#full-banner-inner").outerHeight(true);
			height += $("#subnav-wrap").outerHeight(true);
			
			return (this.top = height);
		},
	  }
	});
	
	$('.ge-collapse').each(function() {
		var item = $(this).attr('href');
		$(item).collapse('hide');
	});
	
	$('#to_top').css('right', function() {
		var width = $(document).width() - $("#wrap").width();
		if(width > 100)
			width = width / 3;
		else
			width = 10;
		return width;
	});
	
	$('#to_top').css('bottom', function() {
		var height = $("#footer").outerHeight(true);
		height += 20;
		return height;
	});
	
	$('.optional.field').css({"display":"none"});
	
	$('#post_type').click( function() {
		var post_type = $('#post_type').find(":selected").val();
		console.log(post_type);
		$('.optional.field').css({"display":"none"});
		$('.field.'+post_type).css({"display":"block"});
	});
	
});

$(window).resize( function() {
	$('#to_top').css('right', function() {
		var width = $(document).width() - $("#wrap").width();
		if(width > 100)
			width = width / 3;
		else
			width = 10;
		return width;
	});
	
	$('#to_top').css('bottom', function() {
		var height = $("#footer").outerHeight(true);
		height += 20;
		return height;
	});

});



