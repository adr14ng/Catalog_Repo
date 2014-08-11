<?php /* Template Name: Export Page */

	
// This is a little script to export he courses into csv format.
// 

$i = 0;
$course_list = array();

// The Query
$the_query = new WP_Query( array('post_type'=>'courses') );

// $file = fopen("courses.csv","w");

if( $the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); 
	
	// get the title
	$title = get_the_title();
	 // echo $title;
	
	// check if the title has a dot
	if (strpos($title, ".") !== false) {
		// split the title at the dot
		$title_split = explode(".", $title);

		// get the course number and subject
		$course_number = $title_split[0];
		$course_number = explode(" ", $course_number); 

		// break subject and course into vars
		$course_subject = $course_number[0];
		$course_number = $course_number[1];

		// get the title
		$course_title = $title_split[1];

		// split course title into title and unit if it has (
		if (strpos($course_title, "(") !== false) {
			$course_title = explode("(", $course_title);
			$title = $course_title[0];
			$unit = str_replace(")","", $course_title[1]);  
		} else {
			// make course unit null as none was given
			$title = $course_title;
			$unit = "null";
		}		

		$course_description = get_the_content();
		
		$course_info = array($course_subject, $course_number, $unit, $title, $course_description, );

		array_push($course_list, $course_info);

	}
	// the title did not have a dot
	else {

		$i++;
	}

endwhile; endif; 
wp_reset_postdata();


$file = fopen("export.csv","w");


foreach ($course_list as $course){
	
	// $course = implode("|", $course);
	
	fputcsv( $file, $course );
 
 }

fclose($file); 



echo $i;





 get_footer(); 

?>