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

		$('[data-toggle="popover"]').popover();
		

	/*var pattern = /([A-Z]{2,4}) ([0-9]{3})([^\s]{0,10}?) (.{1,100}?)( \(.+?\))/g;
	
	$('p').html(function() { 
			var paragraph = this;
			return $(paragraph).html().replace(pattern, function(match, $1, $2, $3) { return get_link(match, $1, $2, $3); });
		}
	);

	function get_link(full, letter, number, suffix){
		var value = letter+' '+number+suffix
		console.log(value);

		var jUrl = "http://www.csun.edu/catalog/catalog/json/?subject="+value+"&type=course";
		var id = letter+number+suffix;
		id = id.replace(/[^A-Za-z0-9]/g, '-');

		$.ajax({
		   url: jUrl,
		   type: 'GET',
		   success: function(data_back){
				 var new_content = '<a href="'+data_back+'">'+full+'</a>';
				 
				 console.log(data_back);
				 
				 if(data_back != '')
					$('#'+id).replaceWith(new_content);
			}
		});
		
		return '<span id="'+id+'">'+full+'</span>'; 
	};*/
	
	$('#abc_nav').children('a').each( function () {
		var letter = $(this).attr('href');
		
		if($(letter).length == 0) {
			$(this).children('span').addClass('disabled');
			$(this).children('span').unwrap();
			console.log(letter);
		}
	});

});

