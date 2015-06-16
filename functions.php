<?php


/* Registering Nav Menu */
register_nav_menu( 'primary', __( 'Primary Menu', 'csuncatalognav' ) );
register_nav_menu( 'about-menu', 'About Menu' );
register_nav_menu( 'rgs-menu', 'RGS Menu' );
register_nav_menu( 'ge-menu', 'GE Menu' );
add_editor_style();


add_action( 'post_submitbox_misc_actions', 'fix_autosave' );
function fix_autosave() { ?>
<a style="float: right; margin: 10px;" id="unlock">unlock</a>
<script>
	jQuery( document ).ready(function()
	{
		console.log( "Custom JS is active");
		jQuery('#unlock').click(function(){
			console.log( "Clciked");
			jQuery('#publish').removeClass("disabled");
		});
	});
</script>
<?php
}

/* Breadcrumbs */
function the_breadcrumb() {
    $post_type = get_post_type();
    global $dept, $deptdesc, $deptterm;
	
	$col = get_term_by('id', $deptterm->parent, 'department_shortname');

    if (!is_home()) {
		echo '<ul id="breadcrumbs">';
		
        echo '<li><a href="'.get_option('home').'/">Home</a></li>';
        echo '<li class="separator"> / </li>';
		
		//Get college
		echo '<li><a href="'.site_url().'/about/colleges/'.$col->slug.'">'.$col->description.'</a></li>';
        echo '<li class="separator"> / </li>';

        //Get department
        echo '<li><a href="'.get_csun_archive('departments', $dept).'">'.$deptdesc.'</a></li>';
        echo '<li class="separator"> / </li>';

        //get post type
        echo '<li><a href="'.get_csun_archive($post_type, $dept).'">'.ucwords ($post_type).'</a></li>';
        echo '<li class="separator"> / </li>';

		if($post_type === "courses")
		{
			$name = explode('.', get_the_title());
			echo '<li><strong>'. $name[0] .'</strong></li>';
		}
		elseif($post_type === "programs")
		{
			echo '<li><strong>'. program_name() .'</strong></li>';
		}
		else
		{
			echo '<li><strong>'. the_title() .'</strong></li>';
		}
		echo '</ul>';
    }
}


/* Removes the brackets from the excerpt 'more' thing */
function new_excerpt_more( $more ) {
    return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');



/** * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Use this function to get the link to the department page,
 * and the lists of programs, courses, and faculty
 *
 * @param string $post_type	Post type of page trying to access
 * @param string $dept_name	Slug of department name
 *
 * @return string
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
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
	if($post_type !== 'programs' || $post_type !== 'courses' || $post_type !== 'faculty' ){
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
		'tax_query' => array(
			array(
				'taxonomy' => 'department_shortname',
				'field' => 'slug',
				'terms' => $dept_name,
				'include_children' => false,
			),
		),
	);
	$departments = get_posts( $args );
	
	if(isset($departments[0])){
		//acf get field
		$contact = get_field('contact', $departments[0]->ID);
	}
	else  //college
	{
		$args = array('post_type' => 'page',
			'meta_query' => array(
				array(
					'key' => 'department_code',
					'value' => $dept_name,
				),
			),
		);
		
		$college = get_posts($args);
		
		if(isset($college[0])) {
			$contact = get_field('contact', $college[0]->ID);
		}
	}
	
	return $contact;
}


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
		$letter = get_query_var( 'directory' );
		if($dept !== '')
			if(!empty($letter))
				echo "Emeriti - ".ucwords($letter);
			else
				echo 'Faculty - '.$deptdesc;
		else
			echo 'Faculty and Administration';
			
	elseif(is_post_type_archive( 'plans')) :
		echo 'Degree Planning Guides';
		
	elseif(is_singular('programs')) : 	
		echo program_name();

		$post_option=get_field('option_title');
		if( !empty($post_option)) {
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
	
	elseif(is_tax('directory')) :
		$letter = get_query_var( 'directory' );
		echo "Faculty and Administration - ".ucwords($letter);
		
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
 *	Forces template to be the one we choose when multiple are possible.
 *	Hooks onto template_include filter.
 *
 *	@param	string $template	The WordPress selected template
 *	@return	string				The template we want
 */
function csun_select_template( $template ){
	global $wp_query;

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
	
	//API calls
	if(isset($wp_query->query_vars['api']))
	{
		$new_template = locate_template('page-json.php');
		if(!empty($new_template))
		{
			$template = $new_template;
		}
	}
	
	//courses popup
	if(isset($wp_query->query_vars['popup']))
	{
		$new_template = locate_template('single-courses-popup.php');
		if(!empty($new_template))
		{
			$template = $new_template;
		}
	}
	
	echo "<!--". basename($template)."-->";
	
	return $template;
}
add_filter('template_include', 'csun_select_template');

/**
 *	Modify the query
 *	Hooks onto pre_get_posts action.
 *
 *	@param	WP_Query $query		The original query object
 */
function modify_query( $query ) {
	//Filters out faculty with Emeriti from faculty directory queries
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
	
	//If no order is specified, alphabetize by title.
	if($query->is_main_query() && !is_search() && !isset($query->query[orderby])) :
		$query->set('orderby', 'title');
		$query->set('order', 'ASC');
	endif;
	
	//Sets post archive limits
	if(!is_admin()){
		if ( is_search())
			$limit = 10;
		else
			$limit = 3000;

		set_query_var('posts_per_archive_page', $limit);
	}
	
	return $query;
}
add_action( 'pre_get_posts', 'modify_query');

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
		'([A-Za-z ]*)'.						//The GE category
	')|'.										//or
	'(Title (?: Five|5|V)(?: requirement)?)'.	//Title 5 type
	'/i';										//Don't worry about case
	
	if(is_singular('plans') || is_singular('staract')) :
		$content = preg_replace_callback( 
			$regex, 
			function ($matches) {
				$url = site_url('/general_education/');
				
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
					elseif(stripos($matches[2], 'arts') !== false)
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
					elseif(stripos($matches[2], 'compara') !== false)
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
					if(empty($name))
					{
						$url .= 'ud';
						$name = 'ud';
					}
					else
					{
						$url .= '+ud';
						$name .= '-ud';
					}
				}
				
				if(!empty($name))
				{
					$link = '<a href="'.$url.'" name="'.$name.'" target="_blank" title="A new window containing GE courses meeting this requirement." class="pop-up">';
					return $link.$matches[0].'</a>';
				}
				else
				{
					return $matches[0];
				}
			}, 
			$content
		);
	endif;
	
	return $content;
}
add_filter( 'the_content', 'add_ge_links');

/**
 *	FOR TEST SITE USE ONLY
 *  Filters links to change from main catalog to test catalog
 *  Hooks onto the_content filter.
 *
 *  @return	$string		Corrected links
 */
function links_test_site($content)
{
	$content = str_ireplace('http://www.csun.edu/catalog', 'http://wwwtest.csun.edu/catalog', $content);
	$content = str_ireplace('/academics/acct/', '/academics/acctis/', $content);
	return $content;
}
add_filter('the_content', 'links_test_site');
add_filter('acf/load_value/name=college_courses',  'links_test_site');
add_filter('acf/load_value/name=mission_statement',  'links_test_site');
add_filter('acf/load_value/name=academic_advisement',  'links_test_site');
add_filter('acf/load_value/name=program_list',  'links_test_site');
add_filter('acf/load_value/name=related_topics',  'links_test_site');
add_filter('acf/load_value/name=program_requirements',  'links_test_site');
add_filter('acf/load_value/name=custom_contact',  'links_test_site');

/**
 *	FOR PRODUCTION SITE USE ONLY
 *  Filters links to change from text catalog to main catalog
 *  Hooks onto the_content filter.
 *
 *  @return	$string		Corrected links
 */
 /*
function links_prod_site($content)
{
	$content = str_ireplace('http://wwwtest.csun.edu/catalog', 'http://www.csun.edu/catalog', $content);
	$content = str_ireplace('/academics/acct/', '/academics/acctis/', $content);
	return $content;
}
add_filter('the_content', 'links_prod_site');
add_filter('acf/load_value/name=college_courses',  'links_prod_site');
add_filter('acf/load_value/name=mission_statement',  'links_prod_site');
add_filter('acf/load_value/name=academic_advisement',  'links_prod_site');
add_filter('acf/load_value/name=program_list',  'links_prod_site');
add_filter('acf/load_value/name=related_topics',  'links_prod_site');
add_filter('acf/load_value/name=program_requirements',  'links_prod_site');
add_filter('acf/load_value/name=custom_contact',  'links_prod_site');
*/

/**
 * Add custom style formats
 * Hooks onto tiny_mce_before_init filter.
 *
 * @param array $init_array	The default wordpress toolbar
 *
 * @return array			The updated wordpress toolbar
 */
function csunFormatTinyMCE( $init_array ) {
	$style_formats = array(  
		// Each array child is a format with it's own settings
		array(  
			'title' => 'Section Title',  
			'block' => 'h2',  
			'classes' => 'section-header',
		),
		array(  
			'title' => 'Link Grid',  
			'block' => 'div',  
			'classes' => 'plan-grid clearfix',
			//'wrapper' => true,
		),
		array(  
			'title' => 'Basic Table',  
			'selector' => 'table',  
			'classes' => 'csun-table',
			//'wrapper' => true,
		),
		array(  
			'title' => 'Table Header/Footer',  
			'selector' => 'tr',  
			'classes' => 'header-footer',
			//'wrapper' => true,
		),
		array(  
			'title' => 'Units',  
			'selector' => 'p',  
			'classes' => 'pseudo-h4',
		),
		array(  
			'title' => 'Space-y',  
			'block' => 'div',
			'classes' => 'spacey',
			'wrapper' => true,
		),
		array(  
			'title' => 'Header 1 Style',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6',  
			'classes' => 'pseudo-h1',
		),
		array(  
			'title' => 'Header 2 Style',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6',  
			'classes' => 'pseudo-h2',
		),
		array(  
			'title' => 'Header 3 Style',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6',  
			'classes' => 'pseudo-h3',
		),
		array(  
			'title' => 'Header 4 Style',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6',  
			'classes' => 'pseudo-h4',
		),
		array(  
			'title' => 'Header 5 Style',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6',  
			'classes' => 'pseudo-h5',
		),
		array(  
			'title' => 'Header 6 Style',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6',  
			'classes' => 'pseudo-h6',
		),
		array(  
			'title' => 'Header 7 Style',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6',  
			'classes' => 'pseudo-h7',
		),
		array(  
			'title' => 'Header 8 Style',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6',  
			'classes' => 'pseudo-h8',
		),
	);
	
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;
}
add_filter('tiny_mce_before_init', 'csunFormatTinyMCE' );



/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
                                            Search
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
  * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
  
/*------------------- Modify Result Look ------------------------------*/

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
		elseif($post->post_type === 'staract') :
			$year = get_the_terms( $id, 'aca_year');
			
			$title = $title.'<span class="option-title">'.$year[0]->name.' STAR Act Planning Guide</span>';
		elseif($post->post_type === 'plans') :
			$year = get_the_terms( $id, 'aca_year');
			
			$title = $title.'<span class="option-title">'.$year[0]->name.' Degree Planning Guide</span>';
		elseif($post->post_type === 'policy_categories' || $post->post_type === 'policy_keywords'
				|| $post->post_type === 'policy_tags') :
			$title = '<span class="type-title">Policies: </span>'.ucwords($title);
		endif;
	endif;
	
	return $title;
}
add_filter('dwls_post_title', 'csun_search_title', 10, 2);

function custom_field_excerpt($excerpt) {
	global $post;

	if($post->post_type === 'departments')
	{
		$raw_excerpt = $excerpt;
		
		$excerpt = get_field('mission_statement', $post->ID);

		$excerpt = strip_shortcodes( $excerpt );

		/** This filter is documented in wp-includes/post-template.php */
		$excerpt = apply_filters( 'the_content', $excerpt);
		$excerpt = str_replace(']]>', ']]&gt;', $excerpt);

		/**
		 * Filter the number of words in an excerpt.
		 *
		 * @since 2.7.0
		 *
		 * @param int $number The number of words. Default 55.
		 */
		$excerpt_length = apply_filters( 'excerpt_length', 55 );

		/**
		 * Filter the string in the "more" link displayed after a trimmed excerpt.
		 *
		 * @since 2.9.0
		 *
		 * @param string $more_string The string shown within the more link.
		 */
		$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
		$excerpt = wp_trim_words( $excerpt, $excerpt_length, $excerpt_more );

		/**
		 * Filter the trimmed excerpt string.
		 *
		 * @since 2.8.0
		 *
		 * @param string $text        The trimmed text.
		 * @param string $raw_excerpt The text prior to trimming.
		 */
		return apply_filters( 'wp_trim_excerpt', $excerpt, $raw_excerpt );
	}

	return $excerpt;
}
add_filter('get_the_excerpt', 'custom_field_excerpt', 0);

/*------------------- Relevanssi ------------------------------*/

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

function is_class_search($search_term)
{
	return preg_match('/([A-Z]{2,4} )(\d{2,3})/i', $search_term);
}


/**
 *	Adds pages back into search queries
 *	Hooks onto relevanssi_search_filters filter
 */
function modify_search_params( $query ) {
	if(isset($_REQUEST['post_type']))
	{
		if(is_array($_REQUEST['post_type']) && in_array('page', $_REQUEST['post_type']))
		{
			if(is_array($query['post_type']))
			{
				if(!in_array('page', $query['post_type']))
				{
					$query['post_type'][] = 'page';
				}
			}
		}
	}
	return $query;
}
add_action( 'relevanssi_search_filters', 'modify_search_params');

function custom_fields_to_excerpts($content, $post, $query) {
    $custom_field = get_field('mission_statement', $post->ID);
    $content .= " " . $custom_field;
    return $content;
}
add_filter('relevanssi_excerpt_content', 'custom_fields_to_excerpts', 10, 3);


function search_result_types( $hits ) {
    global $hns_search_result_type_counts;
    $types = array();
	
    if ( ! empty( $hits ) ) {
        foreach ( $hits[0] as $hit ) {
            $types[$hit->post_type]++;
        }
    }
    $hns_search_result_type_counts = $types;
	
    return $hits;
}
add_filter('relevanssi_hits_filter', 'search_result_types');

/**
 * Only use words that appear more than five times for spelling suggestions.
 * This helps prevent odd spelling suggestions
 * Hooks onto relevanssi_get_words_query
 */
function fix_query($query) {
    $query = $query . " HAVING c > 1";
    return $query;
}
//add_filter('relevanssi_get_words_query', 'fix_query');

/**
 * Weight plans based on aca_year
 *
 */
function aca_year_weights($match)
{
	//will be ordered lowest to highest
	$years = get_terms('aca_year', array('fields'=>'names'));
	$increment = 8 / count($years);
	
	$post_type = relevanssi_get_post_type($match->doc);
	
	if($post_type === 'staract' || $post_type === 'plans')
	{
		$year = get_the_terms( $match->doc, 'aca_year');
		$mult = array_search($year[0]->name, $years);
		$match->weight = $match->weight * (.25 + $mult * $increment);
	}
	
	return $match;
}
add_filter('relevanssi_match', 'aca_year_weights');

/* Empty Search */
function search_trigger($search_ok)
{
	global $wp_query;
	if( (!empty($wp_query->query_vars['post_type']) && $wp_query->query_vars['post_type'] !== 'any')
		&& (!empty($wp_query->query_vars['tax_query']) || !empty($wp_query->query_vars['meta_query'])))
	{
		$search_ok = true;
	}
	
	return $search_ok;
}
add_filter('relevanssi_search_ok', 'search_trigger');

function empty_search( $hits ) {
    global $wp_query;
	
    if ( empty( $hits[0] ) ) {
		$args = parse_advanced_search($_REQUEST);
		unset($args['s']);
		$args['posts_per_page'] = 200;
        $hits[0] = get_posts($args);
		
		//print_r($args);
    }
	
    return $hits;
}
add_filter('relevanssi_hits_filter', 'empty_search');

/*------------------- Advanced ------------------------------*/
function parse_advanced_search($params)
{
	$tax_query = array();
	$meta_query = array();
	
	//college
	if(!empty($params['college']))
	{
		$tax_query[] = array(
			'taxonomy' 	=> 'department_shortname',
			'field'		=> 'slug',
			'terms'		=> $params['college'],
		);
	}
	//department
	if(!empty($params['department']))
	{
		$tax_query[] = array(
			'taxonomy' 	=> 'department_shortname',
			'field'		=> 'slug',
			'terms'		=> $params['department'],
		);
	}
	//department_code
	if(!empty($params['department_code']))
	{
		$tax_query[] = array(
			'taxonomy' 	=> 'department_shortname',
			'field'		=> 'slug',
			'terms'		=> $params['department_code'],
		);
	}
	//degree_level
	if(!empty($params['degree_level']))
	{
		$tax_query[] = array(
			'taxonomy' 	=> 'degree_level',
			'field'		=> 'slug',
			'terms'		=> $params['degree_level'],
		);
	}
	//fund_source
	if(!empty($params['fund_source']))
	{
		$meta_query[] = array(
			'meta_key'		=> 'fund_source',
			'meta_value'	=> $params['fund_source'],
			'compare' 		=> '=',
		);
	}
	//aca_year
	if(!empty($params['aca_year']))
	{
		$tax_query[] = array(
			'taxonomy' 	=> 'aca_year',
			'field'		=> 'slug',
			'terms'		=> $params['aca_year'],
		);
	}
	//hire_year
	if(!empty($params['hire_year']))
	{
		if($params['hire_year'] < 40)
		{
			$params['hire_year'] += 2000;
		}
		elseif($params['hire_year'] < 100)
		{
			$params['hire_year'] += 1900;
		}
		
		$meta_query[] = array(
			'key'		=> 'hire_year',
			'value'		=> array($params['hire_year_start'], $params['hire_year_end']),
			'type'		=> 'numeric',
			'compare' 	=> 'BETWEEN',
		);
		
	}
	//current
	if(!empty($params['current']))
	{
		if(empty($params['administrator']) && empty($params['emeritus']))
		{
			$tax_query[] = array(
				'taxonomy' => 'department_shortname',
				'terms' => array ( 'emeriti',  'admin') ,
				'include_children' => 1 ,
				'field' => 'slug' ,
				'operator' => 'NOT IN',
			);
		}
	}
	//administrator
	if(!empty($params['administrator']))
	{
		if(empty($params['current']))
		{
			$tax_query[] = array(
				'taxonomy' 	=> 'department_shortname',
				'field'		=> 'slug',
				'terms'		=> 'admin',
			);
		}
	}
	//emeritus
	if(!empty($params['emeritus']))
	{
		if(empty($params['current']))
		{
			$tax_query[] = array(
				'taxonomy' 	=> 'department_shortname',
				'field'		=> 'slug',
				'terms'		=> 'emeriti',
			);
		}
	}
	//general_education_department
	if(!empty($params['general_education_department']))
	{
		$tax_query[] = array(
			'taxonomy' 	=> 'department_shortname',
			'field'		=> 'slug',
			'terms'		=> 'ge',
		);
	}
	//general_education
	if(!empty($params['general_education']))
	{
		$tax_query[] = array(
			'taxonomy' 	=> 'general_education',
			'field'		=> 'slug',
			'terms'		=> $params['general_education'],
		);
	}
	
	if(count($tax_query) > 1)
	{
		$tax_query['relation'] = 'AND';
	}
	
	if(count($meta_query) > 1)
	{
		$meta_query['relation'] = 'AND';
	}
	
	$args = array(
		'post_type' 	=> $params['post_type'],
		'meta_query'	=> $meta_query,
		'tax_query'		=> $tax_query,
		'posts_per_page' => 200,
	);
	
	return $args;
}

function advanced_search_description($params)
{
	$des = "";
	switch($params['post_type'])
	{
		case "courses" :
			if(!empty($params['department']) && !empty($params['college']))
			{
				$dept = get_term_by('slug', $params['department'], 'department_shortname');
				$col = get_term_by('slug', $params['college'], 'department_shortname');
				$des = $col->description.": ".$dept->description." ";
			}
			else if(!empty($params['department']))
			{
				$dept = get_term_by('slug', $params['department'], 'department_shortname');
				$des = $dept->description." ";
			}
			else if(!empty($params['college']))
			{
				$col = get_term_by('slug', $params['college'], 'department_shortname');
				$des = $col->description." ";
			}
			$des .= "Courses";
			if(!empty($params['general_education_department']))
			{
				if(!empty($params['general_education']))
				{
					$ge = get_term_by('slug', $params['general_education'], 'general_education');
					$des .= " that satisfy ".$ge->description;
				}
				else
				{
					$des = "GE ".$des;
				}
			}
			break;
		case "programs" :
			if(!empty($params['department']) && !empty($params['college']))
			{
				$dept = get_term_by('slug', $params['department'], 'department_shortname');
				$col = get_term_by('slug', $params['college'], 'department_shortname');
				$des = $col->description.": ".$dept->description." ";
			}
			else if(!empty($params['department']))
			{
				$dept = get_term_by('slug', $params['department'], 'department_shortname');
				$des = $dept->description." ";
			}
			else if(!empty($params['college']))
			{
				$col = get_term_by('slug', $params['college'], 'department_shortname');
				$des = $col->description." ";
			}
			
			if(!empty($params['degree_level']))
			{
				if(!empty($des))
				{
					$des = " in ".$des;
				}
				
				if($params['degree_level'] === 'other')
				{
					$des = 'Other Programs'.$des;
				}
				else
				{
					$des = ucwords($params['degree_level']).'s'.$des;
				}
			}
			else
			{
				$des .= "Programs";
			}
			
			if(!empty($params['fund_source']))
			{
				if($params['fund_source'] == "state,both")
					$des = "State-Funded ".$des;
				elseif($params['fund_source'] == "self,both")
					$des = "Self-Funded ".$des;
			}
			break;
		case "faculty" :
			if(!empty($params['emeritus']))
				$des = "Emeritus ";
			if(!empty($params['current']))
				$des .= "Current ";
			
			if(!empty($params['department']) && !empty($params['college']))
			{
				$dept = get_term_by('slug', $params['department'], 'department_shortname');
				$col = get_term_by('slug', $params['college'], 'department_shortname');
				$des .= $col->description.": ".$dept->description." ";
			}
			else if(!empty($params['department']))
			{
				$dept = get_term_by('slug', $params['department'], 'department_shortname');
				$des .= $dept->description." ";
			}
			else if(!empty($params['college']))
			{
				$col = get_term_by('slug', $params['college'], 'department_shortname');
				$des .= $col->description." ";
			}
			
			if(!empty($params['administrator']))
				$des .= "Administrators";
			else
				$des .= "Faculty";

			if(!empty($params['hire_year']))
			{
				$des .= " hired between ".$params['hire_year_start']
						." and ".$params['hire_year_end'];
			}
			break;
		case "departments" :
			
			if(!empty($params['college']))
			{
				$col = get_term_by('slug', $params['college'], 'department_shortname');
				$des = $col->description." ";
			}
			$des .= "Departments";
			break;
		case "groups" :
			$des = "Groups";
			break;
		case "policies" :
			$des = "Policies";
			break;
		case "staract" :
			if(!empty($params['department']) && !empty($params['college']))
			{
				$dept = get_term_by('slug', $params['department'], 'department_shortname');
				$col = get_term_by('slug', $params['college'], 'department_shortname');
				$des = $col->description.": ".$dept->description." ";
			}
			else if(!empty($params['department']))
			{
				$dept = get_term_by('slug', $params['department'], 'department_shortname');
				$des = $dept->description." ";
			}
			else if(!empty($params['college']))
			{
				$col = get_term_by('slug', $params['college'], 'department_shortname');
				$des = $col->description." ";
			}
			$des .= "STAR Act Plans";
			if(!empty($params['aca_year']))
			{
				$des .= " for ".$params['aca_year'];
			}
			break;
		case "plans" :
			if(!empty($params['department']) && !empty($params['college']))
			{
				$dept = get_term_by('slug', $params['department'], 'department_shortname');
				$col = get_term_by('slug', $params['college'], 'department_shortname');
				$des = $col->description.": ".$dept->description." ";
			}
			else if(!empty($params['department']))
			{
				$dept = get_term_by('slug', $params['department'], 'department_shortname');
				$des = $dept->description." ";
			}
			else if(!empty($params['college']))
			{
				$col = get_term_by('slug', $params['college'], 'department_shortname');
				$des = $col->description." ";
			}
			$des .= "Degree Planning Guides";
			if(!empty($params['aca_year']))
			{
				$des .= " for ".$params['aca_year'];
			}
			break;
	}

	return $des;
}