<?php /* Template Name: json Page */

// command ============================================================
if( !empty($_GET['subject']) && !empty($_GET['type']) ){
	process( $_GET['subject'], $_GET['type'] );
}

function process($subject, $type){	
	if($type == "courses")	{
		$query_courses = new WP_Query(array('post_type' => 'courses', 'order' => 'ASC', 'orderby' => 'title', 'posts_per_page' => 1000, 'department'=> $subject ));
		
		$items = array();
		if($query_courses ->have_posts()) : while($query_courses->have_posts()) : $query_courses->the_post(); 
		
		 	$title = "<h3>" . trim(get_the_title()) . "</h3>";
		  	$data = get_the_content();
			
		   $items[] = array("data" => $title.$data);
		
		endwhile; endif; 
	}
	
$callback_func = (!empty($_GET['callback']) ? $_GET['callback'] : "jsonp_received");
echo $callback_func . "(" . json_encode($items, JSON_UNESCAPED_UNICODE) . ");";
	
}


if(!empty($_GET['special'])){
	special_process( $_GET['special']);
}

function special_process($subject){	
	
$items = array();
$url = "http://curriculum.ptg.csun.edu/terms/fall-2014/classes/art-405";

$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
// Execute
$results = curl_exec($ch);
// Closing
curl_close($ch);


$results = json_decode($results);


foreach($results->classes as $element){

	$data = "<h2>".$element->title."</h2> <br> <p> taught by ".$element->instructors[0]->instructor." @ ".$element->meetings[0]->location." on ".$element->meetings[0]->days."</p>";

	$items[] = array("data" => $data);
}

$callback_func = (!empty($_GET['callback']) ? $_GET['callback'] : "jsonp_received");
echo $callback_func . "(" . json_encode($items, JSON_UNESCAPED_UNICODE) . ");";
	
}

//http://catalog.csun.edu/json/?subject=anth&type=courses
 
?>