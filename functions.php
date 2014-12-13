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
        echo '<li><a href="'.get_option('home').'/">';
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

/**
 *	Sets post archive limits.
 *	Hooks onto pre_get_posts filter.
 */
function limit_posts_per_search_page() {
	if(!is_admin()){
		if ( is_search())
			$limit = 10;
		else
			$limit = 3000;

		set_query_var('posts_per_archive_page', $limit);
	}
}
add_filter('pre_get_posts', 'limit_posts_per_search_page');

/**
 *	Applies an appropriate title for the search page.
 *	Hooks onto the_title filter.
 *
 *	@param	string $title	The post title
 *	@param	int $id			ID of the post in question.
 */
function csun_search_titles($title, $id=false) {
	if((!is_admin()) && is_search()) :
		$title = csun_search_title($title, $id);
	endif;
	
	return $title;
}
add_filter('the_title', 'csun_search_titles', 10, 2);

/**
 *	Creates the appropriate title for a search result.
 *	Hooks onto dwls_post_title filter and the_title filter.
 *
 *	@param	string $title	The post title
 *	@param	int $id			ID of the post in question.
 */
function csun_search_title($title, $id=false) {
	if($id) :
		$post = get_post($id);
		if($post->post_type === 'programs') :
			$title = program_name($id, $title);
			
			$option=get_field('option_title', $id);
			if(isset($option) && $option!=='') : 
				$title = $title.'<span class="option-title">'.$option.' Option</span>';
			endif;
		elseif($post->post_type === 'faculty') :
			$position = "Faculty: ";
			$terms = get_the_term_list(  $id, 'department_shortname', '', ', ');
				if( strpos( $terms, 'Emeriti') !== FALSE) :
				$position = "Emeritus ".$position;
			endif;
				
			if( strpos( $terms, 'Administration') !== FALSE) :
				$admin = true;
				$position = "Administrator: ";
			endif;
				
			if( strpos( $terms, 'Faculty') !== FALSE && $admin) :
				$position = "Administrator and Faculty: ";
			endif;
				
			$title = '<span class="type-title">'.$position.'</span>'.$title;
			
		elseif($post->post_type === 'departments') :
			$post_categories = wp_get_post_categories($id, array('fields' => 'names'));
			
			if($post_categories[0] !== "College") :
				$title = '<span class="type-title">'.$post_categories[0].': '.'</span>'.$title;
			endif;
		endif;
	endif;
	
	return $title;
}
add_filter('dwls_post_title', 'csun_search_title', 10, 2);

/**
 *	Get the program name with correct degree signifier.
 *
 *	@param	int	$id					The programs id
 *	@param	string $program_title	The generic program title
 */
function program_name($id=false, $program_title=false) {
	if(!$id)
		$id=get_the_ID();
	
	$degree = get_field('degree_type', $id);
	
	if(!$program_title)
		$program_title = get_the_title($id);

	if ($degree === 'credential' || $degree === 'Credential'){
		if (strpos($program_title, 'Credential') === FALSE)
			$program_title .= ' Credential';
	}
	else if ($degree === 'authorization' || $degree === 'Authorization'){
		if (strpos($program_title, 'Authorization') === FALSE)
			$program_title .= ' Authorization';
	}
	else if ($degree === 'certificate' || $degree === 'Certificate') {
		if (strpos($program_title, 'Certificate') === FALSE)
			$program_title .= ' Certificate';
	}
	else if ($degree === 'minor' || $degree === 'Minor'){
		$program_title = $degree.' in '.$program_title;
	}
	else if ($degree === 'honors' || $degree === 'Honors' ){
		$program_title = $program_title;
	}
	else {
		$program_title = $program_title.', '.$degree;
	}
	
	return $program_title;
}

/**
 *	Sets up a canonical url for department archive vs overview pages
 */
function the_canonical_url() {
	$dept = get_query_var( 'department_shortname' );
	echo get_csun_archive('departments', $dept);
}

/**
 *	Creates the title text based on page type
 */
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
			echo 'Faculty and Administration';
			
	elseif(is_post_type_archive( 'plans')) :
		echo 'Degree Planning Guides';
		
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
			
	elseif(is_singular('staract')) :
		$title = get_the_title();
		$id = get_the_ID();
		$years = get_the_terms( $id, 'aca_year');

		foreach($years as $year)
			$aca_year = $year->name;
			
		echo $title.' ('.$aca_year.') - STAR Act';
		
	elseif(is_singular('plans')) :
		$title = get_the_title();
		$id = get_the_ID();
		$years = get_the_terms( $id, 'aca_year');

		foreach($years as $year)
			$aca_year = $year->name;
			
		echo $title.' ('.$aca_year.') - Planning Guides';
		
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
		echo 'Information Competence Courses';
		
	elseif(is_tax('department_shortname', 'ge')) :
		echo 'General Education Courses';
		
	elseif(is_tax('aca_year')) :
		$year = get_query_var( 'aca_year' );
		if(!isset($type) || $type == ''){
			$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
			
			if ( false !== strpos($url, 'staract') )
				$type = 'STAR Act';
			else
				$type = 'Plans';
		}
		
		echo $year.' - '.$type;
		
	else:
		wp_title('');
	endif;
		
}

/** * * * * * * * * * * * * * * * * * *
 * Sort an array of terms by their description
 * May work imperfectly for descriptions beginning
 * with the same 4 characters.
 *
 * @param array $terms	Array of terms to be sorted
 *
 * @return array
 * * * * * * * * * * * * * * * * * * */
function sort_terms_by_description($terms){
	$sort_terms = array();
	
	foreach($terms as $term){
		$string = substr(($term->description), 0, 4);
		
			while(array_key_exists($string, $sort_terms))
				$string .= 'a';
			
			$sort_terms[$string] = $term;
	}
	
	ksort($sort_terms);
	
	return $sort_terms;
}

/**
 *	Pulls in the COBAE faculty on the BUS pages
 *	Hooks onto pre_get_posts action.
 *
 *	@param	WP_Query $query		The original query object
 */
function fix_cobae_query( $query ) {

	if(is_post_type_archive( 'faculty') ) :
		$query_vars = $query->query_vars;
		if(isset($query_vars['department_shortname'])) :
			$dept = $query_vars['department_shortname'];
			
			//Show business faculty on BUS page
			if($dept === 'bus') :
				$query->set('department_shortname', 'cobae');
				$query->set('term', 'cobae');
			endif;
		endif;
	endif;
	
	return $query;
}
add_action( 'pre_get_posts', 'fix_cobae_query' );

/**
 *	If no order is specified, alphabetize by title.
 *	Hooks onto pre_get_posts
 *
 *	@param	WP_Query $query		The original query object
 */
function alphabetize_everything($query) {
	if($query->is_main_query() && !is_search() && !isset($query->query[orderby])) {
		$query->set('orderby', 'title');
		$query->set('order', 'ASC');
	}
}
add_action( 'pre_get_posts', 'alphabetize_everything',  3);

/**
 *	Forces template to be the one we choose when multiple are possible.
 *	Hooks onto template_include filter.
 *
 *	@param	string $template	The WordPress selected template
 *	@return	string				The template we want
 */
function csun_select_template( $template ){
	global $wp_query;
	
	//print_r($wp_query->query);
	
	//Faculty directory
	if(isset($wp_query->query_vars['directory'])) {
		$directory_template = locate_template('taxonomy-directory.php');
		if(!empty($directory_template))
		{
			$template = $directory_template;
		}
	}
	
	//Plans by department
	if(isset($wp_query->query_vars['department_shortname']) && isset($wp_query->query_vars['post_type'])
		&& ($wp_query->query_vars['post_type'] === 'plans' || $wp_query->query_vars['post_type'] === 'staract'))
	{
		$new_template = locate_template('archive-plans-department_shortname.php');
		if(!empty($new_template))
		{
			$template = $new_template;
		}
	}
	
	//Plans by Year
	if(isset($wp_query->query_vars['aca_year']) && !isset($wp_query->query_vars['name']))
	{
		$new_template = locate_template('taxonomy-aca_year.php');
		if(!empty($new_template))
		{
			$template = $new_template;
		}
	}
	
	return $template;
}
add_filter('template_include', 'csun_select_template');

/**
 *	Filters out faculty with Emeriti from faculty directory queries
 *	Hooks onto pre_get_posts action.
 *
 *	@param	WP_Query $query		The original query object
 */
function minus_emeriti( $query ) {
	//check that this is directory and not emeriti (only department shortname possible)
	if(isset($query->query_vars['directory']) && !isset($query->query_vars['department_shortname'])) :
		//create the query for no emeriti
		$tax_query = array( array('taxonomy' => 'department_shortname',
			  'terms' => array ( 'emeriti' ) ,
			  'include_children' => 1 ,
			  'field' => 'slug' ,
			  'operator' => 'NOT IN',
		));
	
		//add it
		$query->set('tax_query', $tax_query);
	endif;
	
	return $query;
}
add_action( 'pre_get_posts', 'minus_emeriti');

/**
 *	Searches through content and adds links to GE pages on Star Act
 *		and Degree Planning Guide pages.
 *	Hooks onto the_content filter
 *
 *	@param	string $content		The post's content
 *	@return	string				The filtered content
 */
function add_ge_links( $content ) 
{
	$regex = '/(?<![A-Za-z])'.					//not in the middle of a word
	'(?:GE '.									//Typical GE course start
		'((?:Upper Division)|(?:UD))?'.			//Upper division variations
		'(?:Basic (?:Skills|Subjects):)?'.		//Basic skills variations
		'([A-Za-z ]*)'.							//The GE category
	')|'.										//or
	'(Title (?: Five|5|V)(?: requirement)?)'.	//Title 5 type
	'/i';										//Don't worry about case
	
	if(is_singular('plans') || is_singular('staract')) :
		$content = preg_replace_callback( 
			$regex, 
			function ($matches) {
				$url = site_url('index.php?general_education=');
				
				if(!empty($matches[2])) {	//typical ge section
					if(stripos($matches[2], 'writ') !== false)
					{
						$url .= 'a1';
						$name = 'a1';
					}
					elseif(stripos($matches[2], 'critical') !== false)
					{
						$url .= 'a2';
						$name = 'a2';
					}
					elseif(stripos($matches[2], 'math') !== false)
					{
						$url .= 'a3';
						$name = 'a3';
					}
					elseif(stripos($matches[2], 'oral') !== false)
					{
						$url .= 'a4';
						$name = 'a4';
					}
					elseif(stripos($matches[2], 'natural') !== false)
					{
						$url .= 's1';
						$name = 's1';
					}
					elseif(stripos($matches[2], 'art') !== false)
					{
						$url .= 's2';
						$name = 's2';
					}
					elseif(stripos($matches[2], 'social') !== false)
					{
						$url .= 's3';
						$name = 's3';
					}
					elseif(stripos($matches[2], 'life') !== false)
					{
						$url .= 's4';
						$name = 's4';
					}
					elseif(stripos($matches[2], 'comp') !== false)
					{
						$url .= 's5';
						$name = 's5';
					}
				}
				elseif(!empty($matches[3])) {	//title 5 section
					$url .= 't1,t2,t3,t4';
					$name = 't5';
				}
				
				if(!empty($matches[1])) {		//upper division
					$url .= '+ud';
					$name .= '-ud';
				}
				
				$link = '<a href="'.$url.'" name="'.$name.'" target="_blank" title="A new window containing GE courses meeting this requirement." class="pop-up">';
				
				return $link.$matches[0].'</a>';
			}, 
			$content
		);
	endif;
	
	return $content;
}
add_filter( 'the_content', 'add_ge_links');

/**
 *	Adds quotes when searching for classes because for some reason search
 *		won't find it without it.
 *	Hooks onto relevanssi_search_filters filter
 */
function class_search($params)
{
	$search_term = $params['q'];
	
	//if searching for a class add quotes
	$search_term = preg_replace_callback( 
		'/([A-Z]{2,4} )(\d{2,3})/i', 
		function($matches) {
			//allows searching for XXX 40 to find all 40X level classes
			if($matches[2] > 80 && $matches[2] < 100)
			{
				$matches[0] = $matches[1].'0'.$matches[2];
			}
			
			return '"'.$matches[0].'"';
		}, 
		$search_term
	);
	
	$params['q'] = $search_term;
	
	return $params;
}
add_filter('relevanssi_search_filters', 'class_search');


?>