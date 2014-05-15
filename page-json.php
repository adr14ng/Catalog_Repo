<?php /* Template Name: json Page */


// command ============================================================
if( !empty($_GET['subject']) && !empty($_GET['type']) ){
	process( $_GET['subject'], $_GET['type'] );
}

function process($subject, $type){	

	// course single ========================================================
	if($type === "course"){
	
		global $wpdb;

		// $data = $page_id;
		// $items[] = array("data" => $data);
		
		$query_string = "SELECT $wpdb->posts.*
						FROM $wpdb->posts
						WHERE $wpdb->posts.post_title LIKE '".$subject."%'
						 AND $wpdb->posts.post_status = 'publish'
						 AND $wpdb->posts.post_type = 'courses'
						ORDER BY $wpdb->posts.post_title ASC;";


		$query_course =  $wpdb->get_results($query_string, OBJECT);
		
		if($query_course) : 
			global $post;

			$course = $query_course[0];
			$id = $course->ID;
			
			echo get_permalink($id);
		endif; 
	}
	
}

 
?>