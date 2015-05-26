<?php /* Template Name: json Page */

// command ============================================================
if( !empty($_GET['subject']) && !empty($_GET['type']) ){
	process( $_GET['subject'], $_GET['type'] );
}

if(!empty($_GET['special'])){
	special_process( $_GET['special']);
}

$api = get_query_var( 'api' );

if(!empty($api))
{
	$field = get_query_var( 'field' );
	$dept = get_query_var( 'department' );
	$prog = get_query_var( 'program' );
	$year = get_query_var( 'ayear' );

	if(!empty($dept))
		$data = process_dept_field($dept, $field);

	if(!empty($prog))
		$data = process_prog_field($prog, $field, $year);
		
	$callback_func = (!empty($_GET['callback']) ? $_GET['callback'] : "jsonp_received");
	echo $callback_func . "(" . json_encode($data, JSON_UNESCAPED_UNICODE) . ");";
}

function process($subject, $type){	
	if($type == "courses")	{
		$query_courses = new WP_Query(array('post_type' => 'courses', 'order' => 'ASC', 'orderby' => 'title', 'posts_per_page' => 1000, 'department_shortname'=> $subject ));
		
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

//process_dept_field
function process_dept_field($dept, $field){
	//get post
	$posts = get_posts(array('department_shortname' => $dept, 'post_type' => 'departments'));
	
	$data = array();
	
	if(!empty($field))
	{
		$fields = array($field);
	}
	else
	{
		//add any department field names here
		$fields = array('name', 'url', 'contact', 'accreditation', 'programs');
	}
	
	foreach($fields as $field)
	{
		//send back field
		if($field === 'name')
		{
			$data[$field] = $posts[0]->post_title;
		}
		elseif($field === 'url')
		{
			$data[$field] = get_csun_archive('departments', $dept);
		}
		elseif($field === 'misc')
		{
			$data[$field] = strip_tags($posts[0]->post_content);
		}
		elseif($field === 'programs')
		{
			$data[$field] = get_department_programs($dept);
		}
		else
		{
			$data[$field] = strip_tags(get_field($field, $posts[0]->ID));
		}
	}
	
	return $data;
}

function get_department_programs($dept)
{
	$posts = get_posts(array('department_shortname' => $dept, 'post_type' => 'programs'));
	$data = array();
	
	foreach($posts as $post)
	{
		//post name, degree level, url
		$program_name = program_name($post->ID, $post->post_title);
			
		$option = get_field( 'option_title', $post->ID);
		if(!empty($option))
		{
			$program_name .= ' - '.$option.' Option';
		}
		
		$program_link = get_permalink($post->ID);
		
		$program_levels = get_the_terms($post->ID, 'degree_level');
		
		$data[] = array('name' => $program_name,
		                'url' => $program_link,
						'level' => $program_levels[0]->slug);
	}
	
	return $data;
}

//process program field
function process_prog_field($prog, $field, $year){
	//get post
	$posts = get_posts(array('name'=>$prog, 'post_type'=>'programs'));
	
	$data = array();
	
	if(!empty($field))
	{
		$fields = array($field);
	}
	else
	{
		//add any program field names here
		$fields = array('name', 'url', 'slos', 'plans', 'staract');
	}

	foreach($fields as $field)
	{
		if($field === 'name')
		{
			$program_name = program_name($posts[0]->ID, $posts[0]->post_title);
			
			$option = get_field( 'option_title', $posts[0]->ID);
			if(!empty($option))
			{
				$program_name .= ' - '.$option.' Option';
			}

			$data[$field] = $program_name;
		}
		elseif($field === 'url')
		{
			$data[$field] = get_permalink($posts[0]->ID);
		}
		elseif($field === 'overview')
		{
			$data[$field] = strip_tags($posts[0]->post_content);
		}
		elseif($field === 'plans' || $field === 'staract')
		{
			$data[$field] = get_plan_data($field, $year, $posts[0]->ID);
		}
		else
		{
			$data[$field] = strip_tags(get_field($field, $posts[0]->ID));
		}
	}

	return $data;
}

function get_plan_data($type, $year, $id)
{
	$args = array(
		'posts_per_page'	=> 40,
		'post_type' 		=> $type,
		'meta_query' 		=> array(
			array(
				'key' 		=> 'degree_planning_guides',
				'value' 	=> '"'. $id . '"',
				'compare' 	=> 'LIKE'
			)
		),
		'aca_year' 			=> $year,
		'order'				=> 'ASC',
		'orderby'			=> 'title',
	);
	$plans = get_posts($args);
	foreach($plans as $plan)
	{
		$aca_year = wp_get_post_terms( $plan->ID, 'aca_year');
		$plan_links[] = array('url' => get_permalink($plan->ID), 
		                      'year' => $aca_year[0]->name );
	}
	
	usort($plan_links, "year_sort");
	
	return $plan_links;
}

function year_sort($a, $b)
{
	return strcmp($a["year"], $b["year"]);
}
 
?>