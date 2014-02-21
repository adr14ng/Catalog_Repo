$( document ).ready(function() {
     	console.log( "Custom JS is active");


     	$( "#menuicon" ).click(function() {
     		console.log( "You Clicked it");
  			$( "#csunnav" ).toggleClass( "hideme" );
		});


		$(".dept-container").columnize({ width: 300 });






});

