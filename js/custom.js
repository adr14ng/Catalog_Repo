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






});

