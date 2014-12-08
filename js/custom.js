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

	//$('[data-toggle="popover"]').popover();
		
	
	$('#abc_nav').children('a').each( function () {
		var letter = $(this).attr('href');
		
		if($(letter).length == 0) {
			$(this).children('span').addClass('disabled');
			$(this).children('span').unwrap();
			console.log(letter);
		}
	});
	
	$("h2.section-header").wrap('<span class="section-title"><span></span></span>');
	$('.abc_title').prev('div').addClass('no-bottom-border');
	
	$('h3+table').each(function(){
		$(this).prev('h3').andSelf().wrapAll('<div class ="no-break" />');
	});
	
	$('a.pop-up').click(function(e) {
		e.preventDefault();
		var theWindow = window.open($(this).attr('href'), $(this).attr('name'), 'location=1, toolbar=1, scrollbars=1, resizable=1, width=400, height=450');
		theWindow.focus();
	});
});



