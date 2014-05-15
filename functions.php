<?php


/* Registering Nav Menu */
register_nav_menu( 'primary', __( 'Primary Menu', 'csuncatalognav' ) );
register_nav_menu( 'about-menu', 'About Menu' );
register_nav_menu( 'rgs-menu', 'RGS Menu' );
register_nav_menu( 'ge-menu', 'GE Menu' );

/* Breadcrumbs */
function the_breadcrumb() {

    $post_type = get_post_type();
    global $dept, $deptdesc;


        echo '<ul id="breadcrumbs">';
    if (!is_home()) {
        echo '<li><a href="'.get_option('home').'">';
        echo 'Home';
        echo '</a></li><li class="separator"> / </li>';
        echo '<li>';

        //Get department
        echo '<a href="'.get_csun_archive('departments', $dept).'">';
        echo $deptdesc.'</a>';

        echo ' </li><li class="separator"> / </li><li> ';

        //get post type
        echo '<a href="'.get_csun_archive($post_type, $dept).'">';
        echo ucwords ($post_type).'</a>';

        echo ' </li><li class="separator"> / </li><li> ';

        echo '<strong>'. the_title() .'</strong>';

        echo '</li>';

    }
    echo '</ul>';
}


/* Removes the brackets from the excerpt 'more' thing */
function new_excerpt_more( $more ) {
    return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');



/** * * * * * * * * * * * * * * * * * *
 * Use this function to get the link to the department page,
 * and the lists of programs, courses, and faculty
 *
 * @param string $post_type	Post type of page trying to access
 * @param string $dept_name	Slug of department name
 *
 * @return string
 * * * * * * * * * * * * * * * * * * */
function get_csun_archive($post_type, $dept_name){
    $base = get_bloginfo('url');

    //renamed departments to overview as standard link
    if($post_type == 'departments'){   
        $post_type = 'overview';
    }

    //link format based on CSUN Types
    $url = $base . '/academics/'.$dept_name.'/'.$post_type;

    return $url;
}

/** * * * * * * * * * * * * * * * * * *
 * Used to get link because we need the dept to stay the same throughout
 *
 * @param int|WP_Post 	$id 		Optional. Post ID or post object, defaults to the current post.
 * @param bool 			$leavename 	Optional. Whether to keep post name or page name, defaults to false.
 
 * @return string|bool
 * * * * * * * * * * * * * * * * * * */
function get_csun_permalink($id = 0, $leavename = false){
    $base = get_bloginfo('url');
	
	//Match get_permalink handling
	if ( is_object($id) && isset($id->filter) && 'sample' == $id->filter ) {
		$post = $id;
		$sample = true;
	} else {
		$post = get_post($id);
		$sample = false;
	}

	//We don't have a post
	if ( empty($post->ID) )
		return false;
	
	$post_type = $post->post_type;
	
	//if it isn't one of the links we want to modify
	if($post_type == 'programs' && $post_type == 'programs' && $post_type == 'programs' ){
		return get_permalink($id, $leavename);
	}
	
	//Keep the department name consistent
	$dept_name = get_query_var( 'department_shortname' );
	$post_name = $post->post_name;
	
    //link format based on CSUN Types
    $url = $base . '/academics/'.$dept_name.'/'.$post_type.'/'.$post_name;
	
	//Programs additionally have options
	if($post_type == 'programs'){
		$option = get_field( 'option_title', $post->ID);
				
		if(!$option)
			$option = '';
			
		$option = sanitize_title($option);
		
		if($option)
			$url = $url.'/'.$option;
	}

    return $url;
}

/**
 * Display the department consistent link for the current post.
 */
function the_csun_permalink(){
	echo esc_url( get_csun_permalink() );
	
}

/** * * * * * * * * * * * * * * * * * *
 * Use this function to get the contact information stored
 * in the department
 *
 * @param string $dept_name	Slug of department name
 *
 * @return string
 * * * * * * * * * * * * * * * * * * */
 function get_csun_contact($dept_name) {
	$contact = '';
 
	//Contact is in the department info
	$args=array(
		'post_type' => 'departments',
		'department_shortname' => $dept_name
	);
	$departments = get_posts( $args );
	
	if(isset($departments[0])){
		$department = $departments[0];
	
		//acf get field
		$contact = get_field('contact', $department->ID);
	}
	
	return $contact;
 }
 
function limit_posts_per_search_page() {
	if(!is_admin()){
		if ( is_search())
			$limit = 10;
		else
			$limit = 1000;

		set_query_var('posts_per_archive_page', $limit);
	}
}
add_filter('pre_get_posts', 'limit_posts_per_search_page');


function csun_title_text() {

	$dept = get_query_var( 'department_shortname' );
	$deptterm = get_term_by( 'slug', $dept, 'department_shortname' );
	$deptdesc = $deptterm->description;

	if(is_front_page()) :
		bloginfo('name'); 
	elseif(is_post_type_archive( 'courses')) :	
		if($dept !== '')
			echo 'Courses - '.$deptdesc;
		else
			echo 'All Courses';
			
	elseif(is_post_type_archive( 'departments')) :
		if($dept !== '')
			echo $deptdesc.' Overview';
		else
			echo 'All Departments';
			
	elseif(is_post_type_archive( 'programs')) :
		if($dept !== '')
			echo 'Programs - '.$deptdesc;
		else
			echo 'All Programs';
			
	elseif(is_post_type_archive( 'faculty')) :
		if($dept !== '')
			echo 'Faculty - '.$deptdesc;
		else
			echo 'Faculty';
			
	elseif(is_post_type_archive( 'plans')) :
		echo '4-Year Plans';
		
	elseif(is_singular('programs')) :
		$degree = get_field('degree_type'); 
		$title = get_the_title(); 
				
		if ($degree === 'credential' || $degree === 'Credential'){
			if (strpos($title, 'Credential') === FALSE)
				$title .= ' Credential';
		}
		elseif ($degree === 'certificate' || $degree === 'Certificate') {
			if (strpos($title, 'Certificate') === FALSE)
				$title .= ' Certificate';
		}
		elseif ($degree === 'minor' || $degree === 'Minor'){
			$title = $degree.' in '.$title;
		}
		else{
			$title = $degree.', '.$title;
		}
				
		echo $title;

		$post_option=get_field('option_title');

		if( isset($post_option) && $post_option !== '') {
			echo ' - ' . $post_option;
		}
		else			//otherwise tries to match with next elseif
			echo '';
	
	elseif(is_tax('degree_level')) :
		$level = get_query_var( 'degree_level' );
		echo ucwords($level);
		
	elseif(is_tax('policy_categories')) :
		$policy = get_query_var( 'policy_categories' );
		echo ucwords($policy).' - Policies';
		
	elseif(is_tax('policy_tags')) :
		$policy = get_query_var( 'policy_tags' );
		echo ucwords($policy).' - Policies';
		
	elseif(is_tax('general_education', 'ud')) :
		echo 'Upper Division GE Courses';
		
	elseif(is_tax('general_education', 'ic')) :
		echo 'Iinformation Competence Courses';
		
	elseif(is_tax('department_shortname', 'ge')) :
		echo 'General Education Courses';
		
	elseif(is_tax('aca_year')) :
		$year = get_query_var( 'aca_year' );
		if(!isset($type) || $type == ''){
			$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
			
			if ( false !== strpos($url, 'staract') )
				$type = 'Staract';
			else
				$type = 'Plans';
		}
		
		echo $year.' - '.$type;
		
	else:
		wp_title('');
	endif;
		
}



?>