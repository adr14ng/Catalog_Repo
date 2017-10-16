<?php
/**
*	Plugin Name: CSUN Custom Post Types
*	Description: Adds custom post types and taxonomy for catalog
*	Version: 1.2
*	Author: CSUN Undergraduate Studies
*/

	/**
	 * Creates post types and flushes rewrite rules
	 * Hooks onto activation action.
	 */
	function csun_custom_activate() {
		if( !current_user_can('activate_plugins') )
			return;

		csun_create_post_type();
		flush_rewrite_rules();
	}//activate()
	register_activation_hook( __FILE__, 'csun_custom_activate');

	/**
	 * Unistalling plugin clean up
	 * Hooks onto uninstall action.
	 */
	function csun_custom_uninstall() {
		flush_rewrite_rules();
	}
	register_uninstall_hook( __FILE__, 'csun_custom_uninstall');


	/**
	 * Function to add custom post types and taxonomies
	 * Post Types: courses, programs, departments, faculty, policies, staract,
	 *             plans, groups
	 * Taxonomies: department_shortname, general_education, degree_level,
	 *             aca_year, policy_categories, policy_keywords, directory,
	 *             group_type
	 * Hooks onto init action.
	 */
	function csun_create_post_type() {
		register_post_type( 'courses',
			array(
			'labels' 		=> array(
						'name' 			=> __( 'Courses' ),
						'singular_name' => __( 'Course' ),
						'menu_name' => 'Courses',
						'add_new' => 'Add Course',
						'add_new_item' => 'Add New Course',
						'edit' => 'Edit',
						'edit_item' => 'Edit Course',
						'new_item' => 'New Course',
						'view' => 'View Course',
						'view_item' => 'View Course',
						'search_items' => 'Search Courses',
						'not_found' => 'No Courses Found',
						'not_found_in_trash' => 'No Courses Found in Trash',
				),
			'public' 		=> true,
			'has_archive'	=> true,
			'menu_position'	=> 5,
			'supports' 		=> array(
						'title',
						'editor',
						'revisions'
				),
			'rewrite' => false,
			'delete_with_user' => false,
			//'map_meta_cap'  => true,
			'capability_type' => 'course',
			'capabilities' => array(
				'read_post' => 'read_course',
				'publish_posts' => 'publish_courses',
				'edit_posts' => 'edit_courses',
				'edit_others_posts' => 'edit_others_courses',
				'delete_posts' => 'delete_courses',
				'delete_others_posts' => 'delete_others_courses',
				'read_private_posts' => 'read_private_courses',
				'edit_post' => 'edit_course',
				'delete_post' => 'delete_course',
			),
			)
		);

		register_post_type( 'programs',
			array(
			'labels' 		=> array(
						'name' 			=> __( 'Academic Programs' ),
						'singular_name' => __( 'Program' ),
						'menu_name' => 'Programs',
						'add_new' => 'Add Program',
						'add_new_item' => 'Add New Program',
						'edit' => 'Edit',
						'edit_item' => 'Edit Program',
						'new_item' => 'New Program',
						'view' => 'View Program',
						'view_item' => 'View Program',
						'search_items' => 'Search Programs',
						'not_found' => 'No Programs Found',
						'not_found_in_trash' => 'No Programs Found in Trash',
				),
			'public' 		=> true,
			'has_archive'	=> true,
			'menu_position'	=> 5,
			'supports' 		=> array(
						'title',
						'editor',
						'revisions'
				),
			'rewrite'       => FALSE,
			//'map_meta_cap'  => true,
			'capability_type' => 'program',
			'capabilities' => array(
				'read_post' => 'read_program',
				'publish_posts' => 'publish_programs',
				'edit_posts' => 'edit_programs',
				'edit_others_posts' => 'edit_others_programs',
				'delete_posts' => 'delete_programs',
				'delete_others_posts' => 'delete_others_programs',
				'read_private_posts' => 'read_private_programs',
				'edit_post' => 'edit_program',
				'delete_post' => 'delete_program',
			),
			)
		);

		register_post_type( 'faculty',
			array(
			'labels' 		=> array(
						'name' 			=> __( 'Faculty and Administration' ),
						'singular_name' => __( 'Faculty/Administrator' ),
						'menu_name' => 'Faculty',
						'add_new' => 'Add Faculty',
						'add_new_item' => 'Add New Faculty',
						'edit' => 'Edit',
						'edit_item' => 'Edit Faculty',
						'new_item' => 'New Faculty',
						'view' => 'View Faculty',
						'view_item' => 'View Faculty',
						'search_items' => 'Search Faculty',
						'not_found' => 'No Faculty Found',
						'not_found_in_trash' => 'No Faculty Found in Trash',
				),
			'public' 		=> true,
			'has_archive'	=> true,
			'menu_position'	=> 5,
			'supports' 		=> array(
						'title',
						'editor',
						'revisions'
				),
			'rewrite' => false,
			'delete_with_user' => false,
			//'map_meta_cap'  => true,
			'capability_type' => 'faculty',
			'capabilities' => array(
				'read_post' => 'read_faculty',
				'publish_posts' => 'publish_facultys',
				'edit_posts' => 'edit_facultys',
				'edit_others_posts' => 'edit_others_facultys',
				'delete_posts' => 'delete_facultys',
				'delete_others_posts' => 'delete_others_facultys',
				'read_private_posts' => 'read_private_facultys',
				'edit_post' => 'edit_faculty',
				'delete_post' => 'delete_faculty',
			),
			)
		);

		register_post_type( 'departments',
			array(
			'labels' 		=> array(
						'name' 			=> __( 'Departments' ),
						'singular_name' => __( 'Department' ),
						'menu_name' => 'Departments',
						'add_new' => 'Add Department',
						'add_new_item' => 'Add New Department',
						'edit' => 'Edit',
						'edit_item' => 'Edit Department',
						'new_item' => 'New Department',
						'view' => 'View Department',
						'view_item' => 'View Department',
						'search_items' => 'Search Departments',
						'not_found' => 'No Departments Found',
						'not_found_in_trash' => 'No Departments Found in Trash',
				),
			'public' 		=> true,
			'has_archive'	=> true,
			'menu_position'	=> 5,
			'supports' 		=> array(
						'title',
						'editor',
						'revisions'
				),
			'rewrite' => FALSE,
			'delete_with_user' => false,
			'capability_type' => 'department',
			'capabilities' => array(
				'read_post' => 'read_department',
				'publish_posts' => 'publish_departments',
				'edit_posts' => 'edit_departments',
				'edit_others_posts' => 'edit_others_departments',
				'delete_posts' => 'delete_departments',
				'delete_others_posts' => 'delete_others_departments',
				'read_private_posts' => 'read_private_departments',
				'edit_post' => 'edit_department',
				'delete_post' => 'delete_department',
			),
			)
		);

		register_post_type( 'groups',
			array(
			'labels' 		=> array(
						'name' 			=> __( 'Services and Programs' ),
						'singular_name' => __( 'Service/Program' ),
						'menu_name' => 'Services and Programs',
						'add_new' => 'Add Service/Program',
						'add_new_item' => 'Add New Service/Program',
						'edit' => 'Edit',
						'edit_item' => 'Edit Service/Program',
						'new_item' => 'New Service/Program',
						'view' => 'View Service/Program',
						'view_item' => 'View Service/Program',
						'search_items' => 'Search Services and Programs',
						'not_found' => 'No Services or Programs Found',
						'not_found_in_trash' => 'No Services or Programs Found in Trash',
				),
			'public' 		=> true,
			'has_archive'	=> true,
			'menu_position'	=> 5,
			'supports' 		=> array(
						'title',
						'editor',
						'revisions',
						'author'
				),
			'rewrite' => FALSE,
			'delete_with_user' => false,
			'capability_type' => 'group',
			'capabilities' => array(
				'read_post' => 'read_group',
				'publish_posts' => 'publish_groups',
				'edit_posts' => 'edit_groups',
				'edit_others_posts' => 'edit_others_groups',
				'delete_posts' => 'delete_groups',
				'delete_others_posts' => 'delete_others_groups',
				'read_private_posts' => 'read_private_groups',
				'edit_post' => 'edit_group',
				'delete_post' => 'delete_group',
			),
			)
		);

		register_post_type( 'policies',
			array(
			'labels' 		=> array(
						'name' 			=> __( 'Policies and Procedures' ),
						'singular_name' => __( 'Policy' ),
						'menu_name' => 'Policies and Procedures',
						'add_new' => 'Add Policy',
						'add_new_item' => 'Add New Policy',
						'edit' => 'Edit',
						'edit_item' => 'Edit Policy',
						'new_item' => 'New Policy',
						'view' => 'View Policy',
						'view_item' => 'View Policy',
						'search_items' => 'Search Policies',
						'not_found' => 'No Policies Found',
						'not_found_in_trash' => 'No Policies Found in Trash',
					),
			'public' 		=> true,
			'has_archive'	=> true,
			'menu_position'	=> 5,
			'supports' 		=> array(
						'title',
						'editor',
						'revisions'
				),
			'rewrite' => array('slug' => 'policies'),
			'delete_with_user' => false,
			'capability_type' => 'policy',
			'capabilities' => array(
				'read_post' => 'read_policy',
				'publish_posts' => 'publish_policies',
				'edit_posts' => 'edit_policies',
				'edit_others_posts' => 'edit_others_policies',
				'delete_posts' => 'delete_policies',
				'delete_others_posts' => 'delete_others_policies',
				'read_private_posts' => 'read_private_policies',
				'edit_post' => 'edit_policy',
				'delete_post' => 'delete_policy',
			),
			)
		);

		register_post_type('staract',
			array(
			//'label' => 'Star-act',
			'labels' => array (
			    'name' => 'STAR Act Degree Road Maps',
			    'singular_name' => 'Star-Act',
			    'menu_name' => 'Star-Act',
			    'add_new' => 'Add Star-Act',
			    'add_new_item' => 'Add New Star-Act',
			    'edit' => 'Edit',
			    'edit_item' => 'Edit Star-Act',
			    'new_item' => 'New Star-Act',
			    'view' => 'View Star-Act',
			    'view_item' => 'View Star-Act',
			    'search_items' => 'Search Star-Act',
			    'not_found' => 'No Star-Act Found',
			    'not_found_in_trash' => 'No Star-Act Found in Trash',
			    'parent' => 'Parent Star-Act',),
			'public' => true,
			'has_archive'	=> true,
			'menu_position'	=> 5,
			'supports' 		=> array(
						'title',
						'editor',
						'revisions'
				),
			'rewrite' => array('slug' => 'star-act'),
			'delete_with_user' => false,
			//'map_meta_cap'  => true,
			'capability_type' => 'plan',
			)
		);

		register_post_type('transfer_plans',
			array(
			//'label' => 'Transfer Plan',
			'labels' => array (
			    'name' => 'Transfer Planning Guides',
			    'singular_name' => 'Transfer Plan',
			    'menu_name' => 'Transfer Plans',
			    'add_new' => 'Add Transfer Plan',
			    'add_new_item' => 'Add New Transfer Plan',
			    'edit' => 'Edit',
			    'edit_item' => 'Edit Transfer Plan',
			    'new_item' => 'New Transfer Plan',
			    'view' => 'View Transfer Plan',
			    'view_item' => 'View Transfer Plan',
			    'search_items' => 'Search Transfer Plan',
			    'not_found' => 'No Transfer Plan Found',
			    'not_found_in_trash' => 'No Transfer Plan Found in Trash',
			    'parent' => 'Parent Transfer Plan',),
			'public' => true,
			'has_archive'	=> true,

			'menu_position'	=> 5,
			'supports' 		=> array(
						'title',
						'editor',
						'revisions',
						'author'
				),
			'rewrite' => array('slug' => 'transfer-plan'),
			'delete_with_user' => false,
			//'map_meta_cap'  => true,
			'capability_type' => 'plan',
			)
		);



		register_post_type('plans',
			array(
				//'label' => 'Plans',
				'labels' => array (
					'name' => 'Degree Road Maps',
					'singular_name' => 'Plan',
					'menu_name' => 'Plans',
					'add_new' => 'Add Plan',
					'add_new_item' => 'Add New Plan',
					'edit' => 'Edit',
					'edit_item' => 'Edit Plan',
					'new_item' => 'New Plan',
					'view' => 'View Plan',
					'view_item' => 'View Plan',
					'search_items' => 'Search Plans',
					'not_found' => 'No Plans Found',
					'not_found_in_trash' => 'No Plans Found in Trash',
					'parent' => 'Parent Plan',),
				'public' => true,
				'has_archive'	=> true,
				'menu_position'	=> 5,
				'supports' => array('title','editor','revisions',),
				'hierarchical' => false,
				'rewrite' => array('slug' => 'guides'),
				'delete_with_user' => false,
				//'map_meta_cap'  => true,
				'capability_type' => 'plan',
				'capabilities' => array(
					'read_post' => 'read_plan',
					'publish_posts' => 'publish_plans',
					'edit_posts' => 'edit_plans',
					'edit_others_posts' => 'edit_others_plans',
					'delete_posts' => 'delete_plans',
					'delete_others_posts' => 'delete_others_plans',
					'read_private_posts' => 'read_private_plans',
					'edit_post' => 'edit_plan',
					'delete_post' => 'delete_plan',
				),
			)
		);


	//Custom taxonomies
		//Department short codes, which will include colleges
		register_taxonomy( 'department_shortname', null,
			array(
				'labels'	=> array(
							'name' 			=> __( 'Departments' ),
							'singular_name'	=> __( 'Department' )
							),
				'public'	=> true,
				'show_tagcloud'		=> false,
				'hierarchical'		=> true,
				'capabilities' => array(
					'assign_terms' => 'read'
				),
			)
		);

		//General Education categories
		register_taxonomy( 'general_education', 'courses',
			array(
				'labels'	=> array(
							'name' 			=> __( 'GEs' ),
							'singular_name'	=> __( 'GE' )
							),
				'public'	=> true,
				'show_tagcloud'		=> false,
				'hierarchical'		=> true
			)
		);

		//Program degree levels (Minor, Major, Masters etc)
		register_taxonomy( 'degree_level', 'programs',
			array(
				'labels'	=> array(
							'name' 			=> __( 'Degree Levels' ),
							'singular_name'	=> __( 'Degree Level' )
							),
				'public'	=> true,
				'show_tagcloud'		=> false,
				'hierarchical'		=> true
			)
		);

		//Policy Types (Fees, Conduct)
		register_taxonomy( 'policy_categories', 'policies',
			array(
				'labels'	=> array(
							'name' 			=> __( 'Policy Types' ),
							'singular_name'	=> __( 'Policy Type' )
							),
				'public'			=> true,
				'show_tagcloud'		=> false,
				'hierarchical'		=> true
			)
		);

		//Policy Keywords (money, cheating)
		register_taxonomy( 'policy_keywords', 'policies',
			array(
				'labels'	=> array(
							'name' 			=> __( 'Policy Keywords' ),
							'singular_name'	=> __( 'Policy Keyword' )
							),
				'public'			=> true,
				'show_tagcloud'		=> true,
				'hierarchical'		=> false
			)
		);

		//Policy Tags (money, cheating)
		register_taxonomy( 'policy_tags', 'policies',
			array(
				'labels'	=> array(
							'name' 			=> __( 'Policy Tags' ),
							'singular_name'	=> __( 'Policy Tag' )
							),
				'public'			=> true,
				'show_tagcloud'		=> true,
				'hierarchical'		=> false
			)
		);

		//Year for star act and plans and transfer plans
		register_taxonomy( 'aca_year', null,
			array(
				'labels'	=> array(
							'name' 			=> __( 'Years' ),
							'singular_name'	=> __( 'Year' )
							),
				'public'	=> true,
				'show_tagcloud'		=> false,
				'hierarchical'		=> true,
				'capabilities' => array(
					'assign_terms' => 'edit_plan'
				),
			)
		);

		//Directory tax to do alpha pages
		register_taxonomy( 'directory', 'faculty',
			array(
				'show_ui' => false
			)
		);

		//Group types for services, etc
		register_taxonomy( 'group_type', 'groups',
			array(
				'labels'	=> array(
							'name' 			=> __( 'Group Types' ),
							'singular_name'	=> __( 'Group Type' )
							),
				'public'			=> true,
				'show_tagcloud'		=> false,
				'hierarchical'		=> true,
				'capabilities' => array(
					'assign_terms' => 'edit_group'
				),
			)
		);

	//Assign taxonomies for custom post types
		register_taxonomy_for_object_type( 'department_shortname', 'courses' );
		register_taxonomy_for_object_type( 'department_shortname', 'programs' );
		register_taxonomy_for_object_type( 'department_shortname', 'faculty' );
		register_taxonomy_for_object_type( 'department_shortname', 'departments' );
		register_taxonomy_for_object_type( 'department_shortname', 'plans' );
		register_taxonomy_for_object_type( 'department_shortname', 'staract' );
		register_taxonomy_for_object_type( 'department_shortname', 'transfer_plans' );
		register_taxonomy_for_object_type( 'general_education', 'courses' );
		register_taxonomy_for_object_type( 'degree_level', 'programs' );
		register_taxonomy_for_object_type( 'policy_categories', 'policies' );
		register_taxonomy_for_object_type( 'policy_keywords', 'policies' );
		register_taxonomy_for_object_type( 'policy_tags', 'policies' );
		register_taxonomy_for_object_type( 'aca_year', 'plans' );
		register_taxonomy_for_object_type( 'aca_year', 'staract' );
		register_taxonomy_for_object_type( 'aca_year', 'transfer_plans' );
		register_taxonomy_for_object_type( 'category', 'departments' );
		register_taxonomy_for_object_type( 'post_tag', 'programs' );
		register_taxonomy_for_object_type( 'post_tag', 'departments' );
		register_taxonomy_for_object_type( 'post_tag', 'page' );
		register_taxonomy_for_object_type( 'post_tag', 'policies' );
		register_taxonomy_for_object_type( 'group_type', 'groups' );
		register_taxonomy_for_object_type( 'group_type', 'page' );
	} //csun create post type

	//Add custom post types
	add_action('init', 'csun_create_post_type' );


	/**
	 * Populate Custom Columns
	 * On the edit screen we added collumns, this tells them what to say
	 * Hooks onto manage_posts_custom_column action
	 *
	 * @param string $column	Column trying to populate
	 * @param int $post_id		Post ID of row
	 */
	function custom_columns( $column, $post_id ) {
		switch ( $column ) {
		case 'department' :
			$terms = get_the_term_list( $post_id , 'department_shortname' , '' , ', ' , '' );
				if ( is_string( $terms ) )
				echo $terms;
			else
				_e( '-', 'your_text_domain' );
			break;

		case 'option' :
			$terms = get_field('option_title', $post_id);
			if ( is_string( $terms ) )
				echo $terms;
			else
				_e( '-', 'your_text_domain' );
			break;

		case 'aca_year' :
			$terms = get_the_term_list( $post_id , 'aca_year' , '' , ', ' , '' );
				if ( is_string( $terms ) )
				echo $terms;
			else
				_e( '-', 'your_text_domain' );
			break;

		case 'ge' :
			$terms = get_the_term_list( $post_id , 'general_education' , '' , ', ' , '' );
				if ( is_string( $terms ) )
				echo $terms;
			else
				_e( '-', 'your_text_domain' );
			break;

		case 'pol_cat' :
			$terms = get_the_term_list( $post_id , 'policy_categories' , '' , ', ' , '' );
				if ( is_string( $terms ) )
				echo $terms;
			else
				_e( '-', 'your_text_domain' );
			break;

		case 'pol_tag' :
			$terms = get_the_term_list( $post_id , 'policy_tags' , '' , ', ' , '' );
				if ( is_string( $terms ) )
				echo $terms;
			else
				_e( '-', 'your_text_domain' );
			break;

		case 'level' :
			$terms = get_field('degree_type',$post_id);
			if ( is_string( $terms ) )
				echo $terms;
			else
				_e( '-', 'your_text_domain' );
			break;
		case 'pol_rank' :
			$rank = get_field('pol_rank',$post_id);
			if(is_string( $rank ))
				echo $rank;
			else
				_e( '-', 'your_text_domain' );
			break;

		case 'group_type' :
			$terms = get_the_term_list( $post_id , 'group_type' , '' , ', ' , '' );
				if ( is_string( $terms ) )
				echo $terms;
			else
				_e( '-', 'your_text_domain' );
			break;
		}
	}
	add_action( 'manage_posts_custom_column' , 'custom_columns', 10, 2 );

	/**
	 * Adds custom columns to Plans and Staract
	 * Hooks onto manage_edit-plans_columns filter, manage_edit-staract_columns filter
	 *
	 * @param array $columns	Default columns
	 *
	 * @return array	Updated list of columns
	 */
	function plan_columns($columns) {
		$columns['aca_year'] = 'Year';
		$columns['department'] = 'Department';
		return $columns;
	}
	add_filter('manage_edit-plans_columns', 'plan_columns');
	add_filter('manage_edit-staract_columns', 'plan_columns');
	add_filter('manage_edit-transfer_plans_columns', 'plan_columns');

	/**
	 * Adds sortable columns to Plans and Staract
	 * Hooks onto manage_edit-plans_sortable_columns filter, manage_edit-staract_sortable_columns filter
	 *
	 * @param array $columns	Default sortable columns
	 *
	 * @return array	Updated list of sortable columns
	 */
	function sortable_plan_column( $columns ) {
		$columns['aca_year'] = 'aca_year';

		return $columns;
	}
	add_filter( 'manage_edit-plans_sortable_columns', 'sortable_plan_column' );
	add_filter( 'manage_edit-staract_sortable_columns', 'sortable_plan_column' );
	add_filter( 'manage_edit-transfer_plans_sortable_columns', 'sortable_plan_column' );

	/**
	 * Creates logic for sorting by aca_year
	 * Hooks onto posts_orderby filter.
	 *
	 * @param string $orderby		ASC or DESC ordering
	 * @param WP_QUERY $wp_query	Current database query parameters
	 *
	 * @return string	Ordered database query
	 */
	function csun_custom_order($orderby, $wp_query){
		global $wpdb;

		if ( isset( $wp_query->query['orderby'] ) && 'aca_year' == $wp_query->query['orderby'] ) {
			$orderby = "(
				SELECT GROUP_CONCAT(name ORDER BY name ASC)
				FROM $wpdb->term_relationships
				INNER JOIN $wpdb->term_taxonomy USING (term_taxonomy_id)
				INNER JOIN $wpdb->terms USING (term_id)
				WHERE $wpdb->posts.ID = object_id
				AND taxonomy = 'aca_year'
				GROUP BY object_id
			) ";
			$orderby .= ( 'ASC' == strtoupper( $wp_query->get('order') ) ) ? 'ASC' : 'DESC';
		}

		return $orderby;
	}
	add_filter('posts_orderby', 'csun_custom_order', 10, 2);


	/**
	 * Adds department columns to Faculty and Departments
	 * Hooks onto manage_edit-faculty_columns filter, manage_edit-departments_columns filter
	 *
	 * @param array $columns	Default columns
	 *
	 * @return array	Updated list of columns
	 */
	function dept_columns($columns) {
		$columns['department'] = 'Department';
		return $columns;
	}
	add_filter('manage_edit-faculty_columns', 'dept_columns');
	add_filter('manage_edit-departments_columns', 'dept_columns');

	/**
	 * Adds custom columns to Programs
	 * Hooks onto manage_edit-programs_columns filter
	 *
	 * @param array $columns	Default columns
	 *
	 * @return array	Updated list of columns
	 */
	function prog_columns($columns) {
		$columns['option'] = 'Option Title';
		$columns['department'] = 'Department';
		$columns['level'] = 'Degree';
		return $columns;
	}
	add_filter('manage_edit-programs_columns', 'prog_columns');

	/**
	 * Adds columns to Courses
	 * Hooks onto manage_edit-courses_columns filter
	 *
	 * @param array $columns	Default columns
	 *
	 * @return array	Updated list of columns
	 */
	function course_columns($columns) {
		$columns['department'] = 'Department';
		$columns['ge'] = 'Gen Ed';
		return $columns;
	}
	add_filter('manage_edit-courses_columns', 'course_columns');

	/**
	 * Adds department columns to Faculty and Departments
	 * Hooks onto manage_edit-faculty_columns filter, manage_edit-departments_columns filter
	 *
	 * @param array $columns	Default columns
	 *
	 * @return array	Updated list of columns
	 */
	function group_columns($columns) {
		$columns['group_type'] = 'Type';
		unset($columns['date']);
		return $columns;
	}
	add_filter('manage_edit-groups_columns', 'group_columns');

	/**
	 * Adds columns to Policies
	 * Hooks onto manage_edit-policies_columns filter
	 *
	 * @param array $columns	Default columns
	 *
	 * @return array	Updated list of columns
	 */
	function policy_columns($columns) {
		$columns['pol_cat'] = 'Policy Category';
		$columns['pol_tag'] = 'Policy Tags';
		$columns['pol_rank'] = 'Sort Order';
		return $columns;
	}
	add_filter('manage_edit-policies_columns', 'policy_columns');

	/**
	 * Adds sortable columns to Policies
	 * Hooks onto manage_edit-policies_sortable_columns filter
	 *
	 * @param array $columns	Default sortable columns
	 *
	 * @return array	Updated list of sortable columns
	 */
	function sortable_policy_column( $columns ) {
		$columns['pol_rank'] = 'pol_rank';

		return $columns;
	}
	add_filter( 'manage_edit-policies_sortable_columns', 'sortable_policy_column' );

	/**
	 * Creates logic for sorting by pol_rank
	 * Hooks onto pre_get_posts filter.
	 *
	 * @param WP_QUERY $query	Current database query parameters
	 */
	function csun_custom_pol_order( $query ) {
		if ( $query->is_main_query() && ( $orderby = $query->get( 'orderby' ) ) ) {
			switch( $orderby ) {
				case 'pol_rank' :
					$query->set( 'meta_key', 'pol_rank' );
					$query->set( 'orderby', 'meta_value_num' );
					break;
			}
		}
	}
	add_action( 'pre_get_posts', 'csun_custom_pol_order', 5 );

	/**
	 * Add pol_rank to the quick edit options
	 * Hooks onto quick_edit_custom_box action.
	 *
	 * @param string $column_name	The column we are adding
	 */
	function add_pol_rank_quick_edit($column_name)
	{
		if($column_name !== 'pol_rank')
			return;
		?>
		<fieldset class="inline-edit-col-left">
		<div class="inline-edit-col">
			<span class="title">Policy Order</span>
			<input type="hidden" name="pol_rank_set_noncename" id="pol_rank_set_noncename" value="" />
			<input type="number" id="pol_rank_set" name="pol_rank_set" value=""/>
		</div>
		</fieldset>
		<?php
	}
	add_action('quick_edit_custom_box', 'add_pol_rank_quick_edit');

	/**
	 * Saves policy rank.
	 * Hooks onto save_post action.
	 *
	 *	@param int $post_id		The post id the rank belongs to
	 */
	function save_pol_rank($post_id)
	{
		//if autosave, don't do anything
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		//only for policies
		if($_POST['post_type'] !== 'policies')
			return;

		//have correct permission
		if( !current_user_can( 'edit_post', $post_id))
			return;

		$post = get_post($post_id);
		if(isset($_POST['pol_rank_set']) && ($post->post_type !== 'revision'))
		{
			$rank = esc_attr($_POST['pol_rank_set']);

			if($rank)
			{
				update_field('pol_rank', $rank, $post_id);
			}
		}
	}
	add_action('save_post', 'save_pol_rank');

	/**
	 * Populates pol_rank data in quick edit.
	 * Hooks onto admin_footer action.
	 */
	function pol_rank_javascript() {
		global $current_screen;

		if (($current_screen->id != 'edit-policies') || ($current_screen->post_type != 'policies')) return;
		?>
			<script type="text/javascript">
			<!--
			function set_inline_pol_rank(polRank, nonce) {
				// revert Quick Edit menu so that it refreshes properly
				inlineEditPost.revert();

				var polRankInput = document.getElementById('pol_rank_set');
				var nonceInput = document.getElementById('pol_rank_set_noncename');
				nonceInput.value = nonce;
				polRankInput.value = polRank;
			}
			//-->
			</script>
		<?php
	}
	add_action('admin_footer', 'pol_rank_javascript');

	/**
	 * Displays pol_rank in quick edit.
	 * Hooks onto post_row_actions filter.
	 *
	 *	@param	array $actions	Wordpress actions
	 *	@param	WP_Post $post	The post object
	 */
	function pol_rank_add_value($actions, $post) {
		global $current_screen;

		if (($current_screen->id != 'edit-policies') || ($current_screen->post_type != 'policies')) return $actions;

		$nonce = wp_create_nonce( 'pol_rank'.$post->ID);
		$meta_rank = get_field('pol_rank', $post->ID);

		$actions['inline hide-if-no-js'] = '<a href="#" class="editinline" title="';
		$actions['inline hide-if-no-js'] .= esc_attr( __( 'Edit this item inline' ) ) . '" ';
		$actions['inline hide-if-no-js'] .= " onclick=\"set_inline_pol_rank('{$meta_rank}', '{$nonce}')\">";
		$actions['inline hide-if-no-js'] .= __( 'Quick&nbsp;Edit' );
		$actions['inline hide-if-no-js'] .= '</a>';
		return $actions;
	}
	add_filter('post_row_actions', 'pol_rank_add_value', 10, 2);

	/**
	 * Remove extra columns from list tables
	 * Hooks onto manage_edit-{post_type}_columns filter
	 *
	 * @param array $defaults Default column list
	 *
	 * @return array	Reduced column list
	 */
	function reduce_generic_columns($defaults) {
	  unset($defaults['author']);
	  unset($defaults['date']);
	  unset($defaults['tags']);
	  return $defaults;
	}
	add_filter('manage_edit-courses_columns', 'reduce_generic_columns');
	add_filter('manage_edit-programs_columns', 'reduce_generic_columns');
	add_filter('manage_edit-faculty_columns', 'reduce_generic_columns');
	add_filter('manage_edit-departments_columns', 'reduce_generic_columns');
	add_filter('manage_edit-policies_columns', 'reduce_generic_columns');

 /**
  * Custom rewrite rules for url structure
  * Hooks onto init action.
  */
function csun_add_rewrite_rules() {
	global $wp_rewrite;

	$wp_rewrite->add_rewrite_tag('%programs%', '([^/]+)', 'programs=');
	$wp_rewrite->add_rewrite_tag('%faculty%', '([^/]+)', 'faculty=');
	$wp_rewrite->add_rewrite_tag('%courses%', '([^/]+)', 'courses=');
	$wp_rewrite->add_rewrite_tag('%departments%', '([^/]+)', 'departments=');
	$wp_rewrite->add_rewrite_tag('%star-act%', '([^/]+)', 'star-act=');
	$wp_rewrite->add_rewrite_tag('%guides%', '([^/]+)', 'guides=');
	$wp_rewrite->add_rewrite_tag('%policies%', '([^/]+)', 'policies=');
	$wp_rewrite->add_rewrite_tag('%dpt_name%', '([^/]+)', 'department_shortname=');
    $wp_rewrite->add_rewrite_tag('%degree_level%', '([^/]+)', 'degree_level=');
	$wp_rewrite->add_rewrite_tag('%policy_tags%', '([^/]+)', 'policy_tags=');
	$wp_rewrite->add_rewrite_tag('%policy_keywords%', '([^/]+)', 'policy_keywords=');
	$wp_rewrite->add_rewrite_tag('%policy_categories%', '([^/]+)', 'policy_categories=');
	$wp_rewrite->add_rewrite_tag('%aca_year%', '([^/]+)', 'aca_year=');
	$wp_rewrite->add_rewrite_tag('%option_name%', '([^/]+)', 'option_title=');
	$wp_rewrite->add_rewrite_tag('%post_type%', '([^/]+)', 'post_type=');

	//Groups Pagaes
	$wp_rewrite->add_permastruct('groups', 'groups/%groups%', false);
	add_rewrite_rule('^groups/([A-Za-z-]*)\/?', 'index.php?post_type=groups&groups=$matches[1]', 'top');

	//Department Pages
	add_rewrite_rule('^academics/([a-z]+)/overview/?','index.php?post_type=departments&department_shortname=$matches[1]','top');

	//Policies
	//Need to use conditional template
	add_rewrite_rule('^policies/alphabetical/?','index.php?post_type=policies&order=asc&orderby=title','top');
	add_rewrite_rule('^policies/appendix/?','index.php?post_type=policies&order=asc&orderby=policy_categories','top');
	add_rewrite_rule('^policies/keywords/([0-9a-z-_]+)/?', 'index.php?policy_tags=$matches[1]', 'top');
	add_rewrite_rule('^policies/tags/([0-9a-z-_]+)/?', 'index.php?policy_keywords=$matches[1]', 'top');
	add_rewrite_rule('^policies/categories/([0-9a-z-_]+)/?', 'index.php?policy_categories=$matches[1]', 'top');

	//Faculty
	add_rewrite_rule('^emeriti/([a-zA-Z])/?', 'index.php?post_type=faculty&department_shortname=emeriti&directory=$matches[1]', 'top');
	add_rewrite_rule('^emeriti/?', 'index.php?post_type=faculty&department_shortname=emeriti&directory=a', 'top');
	add_rewrite_rule('^faculty/([a-zA-Z])/?', 'index.php?post_type=faculty&directory=$matches[1]', 'top');


	//Core Pages (Department, Program, Courses and Faculty)
	$wp_rewrite->add_permastruct('programs', 'academics/%dpt_name%/programs/%programs%/%option_name%', false);
	$wp_rewrite->add_permastruct('faculty', 'academics/%dpt_name%/faculty/%faculty%', false);
	$wp_rewrite->add_permastruct('courses', 'academics/%dpt_name%/courses/%courses%', false);
	$wp_rewrite->add_permastruct('departments', 'department/%dpt_name%/%departments%', false);
	$wp_rewrite->add_permastruct('department_shortname', 'academics/%dpt_name%/%post_type%', false);

	add_rewrite_rule('^popup/([A-Za-z0-9-]*)/?', 'index.php?courses=$matches[1]&popup=true', 'top');

	//4 Year Plans Star Act & 2 Year Plans
	$wp_rewrite->add_permastruct('staract', 'resource/star-act/%aca_year%/%staract%', false);
	$wp_rewrite->add_permastruct('plans', 'resource/road-map/%aca_year%/%plans%', false);
	$wp_rewrite->add_permastruct('transfer_plans', 'resource/transfer-road-map/%aca_year%/%transfer_plans%', false);
	$wp_rewrite->add_permastruct('aca_year', 'resource/%post_type%/%aca_year%', false);
	add_rewrite_rule('^resources/star-act/?', 'index.php?page_id=29380=$matches[1]', 'top');
	add_rewrite_rule('^resources/transfer-road-map/?', 'index.php?page_id=137799=$matches[1]', 'top');
	add_rewrite_rule('^resource/road-map/([A-Za-z]{2,10})/?', 'index.php?post_type=plans&department_shortname=$matches[1]', 'top');
	add_rewrite_rule('^resource/star-act/([A-Za-z]{2,10})/?', 'index.php?post_type=staract&department_shortname=$matches[1]', 'top');
	add_rewrite_rule('^resource/transfer-road-map/([A-Za-z]{2,10})/?', 'index.php?post_type=transfer_plans&department_shortname=$matches[1]', 'top');
	add_rewrite_rule('^resource/([A-Za-z]*)/([A-Za-z]{2,10})/?', 'index.php?post_type=$matches[1]&department_shortname=$matches[2]', 'top');

	//List pages for degree level
	$wp_rewrite->add_permastruct('degree_level', 'programs/%degree_level%', false);

	//JSON
	add_rewrite_rule('^api/department/([a-z-_]+)/([a-z-_]+)/?','index.php?api=dept&department=$matches[1]&field=$matches[2]','top');
	add_rewrite_rule('^api/department/([a-z-_]+)/?','index.php?api=dept&department=$matches[1]','top');
	add_rewrite_rule('^api/program/([a-z-_]+)/([a-z-_]+)/([0-9]{4})/?','index.php?api=prog&program=$matches[1]&field=$matches[2]&ayear=$matches[3]','top');
	add_rewrite_rule('^api/program/([a-z-_]+)/([a-z-_]+)/?','index.php?api=prog&program=$matches[1]&field=$matches[2]','top');
	add_rewrite_rule('^api/program/([a-z-_]+)/?','index.php?api=prog&program=$matches[1]','top');

	//print_r($wp_rewrite->extra_permastructs);
}
add_action('init', 'csun_add_rewrite_rules');

/**
 * Custom query variables to make json api work
 * Hooks onto query_vars filter.
 */
function add_query_vars($qvars) {
	$qvars[] = 'api';
	$qvars[] = 'department';
	$qvars[] = 'field';
	$qvars[] = 'program';
	$qvars[] = 'ayear';
	$qvars[] = 'popup';
	return $qvars;
}
add_filter('query_vars','add_query_vars');

/**
 * Replace placeholders in rewrite rules
 * Hooks onto post_type_link filter.
 *
 * @param string $permalink	The link format without replacements
 * @param WP_Post $post		The post the link refers to
 * @param bool $leavename	Wordpress flag
 *
 * @return string	Updated permalink
 */
function csun_permalinks($permalink, $post, $leavename) {
	//Defaults
	$option_df = '';
	$dpt_df = 'nodpt';
	$year_df = '0000';

	$post_id = $post->ID;
	$post_type = $post->post_type;

	if($post_type === 'plans')
		$permalink = str_replace('%post_type%', 'road-map', $permalink);
	else
		$permalink = str_replace('%post_type%', $post_type, $permalink);

	if($post_type === 'transfer_plans')
		$permalink = str_replace('%post_type%', 'transfer-road-map', $permalink);
	else
		$permalink = str_replace('%post_type%', $post_type, $permalink);

	if($post_type === 'staract')
		$permalink = str_replace('%post_type%', 'star-act', $permalink);
	else
		$permalink = str_replace('%post_type%', $post_type, $permalink);

	//if not one our special post types or it doesn't need a permalink yet, just return the default
	if(($post_type != 'programs' && $post_type != 'faculty' && $post_type != 'departments' && $post_type != 'courses'
		&& $post_type != 'staract' && $post_type != 'plans' && $post_type != 'transfer_plans') ||
		empty($permalink) || in_array($post->post_status, array('draft', 'pending', 'auto-draft')))
		return $permalink;

	if($post_type == 'staract' || $post_type == 'plans' || $post_type == 'transfer_plans') {
		$terms =  wp_get_post_terms( $post_id, 'aca_year' );

		if(isset($terms[0]))
			$year = $terms[0]->slug;
		else
			$year = $year_df;

		$year = sanitize_title($year);

		$permalink = str_replace('%aca_year%', $year, $permalink);

		return $permalink;
	}

	if($post_type == 'programs'){
		$option = get_field( 'option_title', $post_id);

		if(empty($option))
		{
			$permalink = str_replace('/%option_name%', '', $permalink);	//no double slash
		}
		else
		{
			$option = sanitize_title($option);
			$permalink = str_replace('%option_name%', $option, $permalink);
		}
	}

	//get the category
	if(isset($_REQUEST['department_shortname'])){
		$dpt = $_REQUEST['department_shortname'];
	}
	//otherwise, figure out category from post (courses, programs, departments)
	else{
		//get all departments relating to the post
		$terms =  wp_get_post_terms( $post_id, 'department_shortname' );

		foreach($terms as $term){
			//ge and top level terms can't be the category
			if($term->slug !== 'ge' && $term->parent != 0 && $term->parent != 511) {
				//save the slug of the category that works
				$dpt = $term->slug;
			}
		}

		if(!isset($dpt)){		//if it only has a top level term
			foreach($terms as $term){
				if($term->slug !== 'ge') {
					//save the slug of the category that works
					$dpt = $term->slug;
				}
			}
		}
	}

	if(!isset($dpt))
		$dpt = $dpt_df;

	//Sanatize fields
	$dpt = sanitize_title($dpt);

	$permalink = str_replace('%dpt_name%', $dpt, $permalink);

	return $permalink;
}
add_filter('post_type_link', 'csun_permalinks', 10, 3);

/**
 * Automatically adds the first letter of faculty to directory tax
 * Hooks onto save_post action.
 */
 function csun_save_first_letter($post_id) {
	//if autosave, don't do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;

	//only for faculty
	if($_POST['post_type'] !== 'faculty')
		return;

	//have correct permission
	if( !current_user_can( 'edit_post', $post_id))
		return;

	//set term as first letter of title
	wp_set_post_terms( $post_id, strtolower(substr($_POST['post_title'], 0, 1)), 'directory');
 }
 add_action('save_post', 'csun_save_first_letter');


 /**
 * Define default terms for custom taxonomies in WordPress 3.0.1
 * Hooks onto save_post action.
 *
 * @author	Michael Fields	http://wordpress.mfields.org/
 * @props	John P. Bloch	http://www.johnpbloch.com/
 *
 * @since	2010-09-13
 * @alter	2010-09-14
 *
 * @license		GPLv2
 */
function mfields_set_default_object_terms( $post_id, $post ) {
	if ( 'publish' === $post->post_status ) {
		$defaults = array(
			'degree_level' => array('other'),
			);
		$taxonomies = get_object_taxonomies( $post->post_type );
		foreach ( (array) $taxonomies as $taxonomy ) {
			$terms = wp_get_post_terms( $post_id, $taxonomy );
			if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
				wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
			}
		}
	}
}
add_action( 'save_post', 'mfields_set_default_object_terms', 100, 2 );

/**
 * Defines rules for creating post slugs for our post types
 * Hooks onto wp_insert_post_data
 *
 */
function custom_post_slugs($data, $postarr)
{
	$post = get_post($post_ID);
	$expect_name = sanitize_title(strtolower($data['post_title']));
	if(!empty($data['post_name']) && (empty($post->post_name) ||
		$data['post_name'] == $expect_name ) )
	{
		if($data['post_type'] === 'courses')  //AAA 101. Generic Class (3) -> aaa-101
		{
			$name = explode('.', $data['post_title']);
			$slug = str_replace('-', '', $name[0]);
			$slug = sanitize_title(strtolower($slug));
			$slug = wp_unique_post_slug($slug, $data['ID'], $data['post_status'], $data['post_type'], $data['post_parent']);
			$data['post_name'] = $slug;
		}

		if($data['post_type'] === 'departments')  //Generic Department -> generic-department-overview
		{
			$slug = sanitize_title(strtolower($data['post_title']));
			$slug = $slug.'-overview';
			$slug = wp_unique_post_slug($slug, $data['ID'], $data['post_status'], $data['post_type'], $data['post_parent']);
			$data['post_name'] = $slug;
		}

		if($data['post_type'] === 'programs')  //ba-africana-studies-ii
		{
			$slug = sanitize_title(strtolower($data['post_title']));
			$degree_type = $postarr['fields']['field_52a20d3fecd1c'];
			$degree_type = strtolower(str_replace(array('.', ' '), '', $degree_type));
			if(strpos($slug, $degree_type) === false)
			{
				$slug = $degree_type.'-'.$slug;
			}
			$slug = program_option_slug($slug, $postarr['fields']['field_52a20d1decd1b']);
			$slug = wp_unique_post_slug($slug, $data['ID'], $data['post_status'], $data['post_type'], $data['post_parent']);
			$data['post_name'] = $slug;
		}

		if($data['post_type'] === 'plans')  //generic-plan-2015
		{
			$slug = sanitize_title(strtolower($data['post_title']));
			//add year
			$year = $postarr['tax_input']['aca_year'];
			if(isset($year[1]))
			{
				$year_term = get_term($year[1], 'aca_year');
				$slug = $slug.'-'.$year_term->slug;
			}
			$slug = wp_unique_post_slug($slug, $data['ID'], $data['post_status'], $data['post_type'], $data['post_parent']);
			$data['post_name'] = $slug;
		}

		if($data['post_type'] === 'transfer_plans')  //generic-plan-2015
		{
			$slug = sanitize_title(strtolower($data['post_title']));
			//add year
			$year = $postarr['tax_input']['aca_year'];
			if(isset($year[1]))
			{
				$year_term = get_term($year[1], 'aca_year');
				$slug = $slug.'-'.$year_term->slug;
			}
			$slug = wp_unique_post_slug($slug, $data['ID'], $data['post_status'], $data['post_type'], $data['post_parent']);
			$data['post_name'] = $slug;
		}

		if($data['post_type'] === 'staract')  //generic-staract-2015
		{
			$slug = sanitize_title(strtolower($data['post_title']));
			//add year
			$year = $postarr['tax_input']['aca_year'];
			if(isset($year[1]))
			{
				$year_term = get_term($year[1], 'aca_year');
				$slug = 'star-act-'.$slug.'-'.$year_term->slug;
			}
			$slug = wp_unique_post_slug($slug, $data['ID'], $data['post_status'], $data['post_type'], $data['post_parent']);
			$data['post_name'] = $slug;
		}
	}

	return $data;
}
add_filter('wp_insert_post_data', 'custom_post_slugs', 10, 2);


function program_option_slug($slug, $option)
{
	$numerals = array('-i', '-ii', '-iii', '-iv', '-v', '-vi', '-vii', '-viii', '-ix', '-x', '-xi', '-xii');
	$largest = 0;
	global $wpdb;
	$check_sql = "SELECT post_name FROM $wpdb->posts WHERE post_name LIKE %s AND post_type = %s";
	$programs = $wpdb->get_results( $wpdb->prepare( $check_sql, $slug.'%', 'programs') );
	if($wpdb->num_rows > 0)
	{
		foreach($programs as $program)
		{
			foreach($numerals as $k=>$num)
			{
				if(strpos($program->post_name, $num) !== false)
				{
					if($k > $largest)
					{
						$largest = $k;
					}
				}
			}
		}

		$slug.=$numerals[$largest+1];
	}
	elseif(!empty($option))
	{
		$slug.=$numerals[0];
	}

	return $slug;
}

function my_myme_types($mime_types){
	$mime_types['epub'] = 'application/epub+zip';
	return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);

/**
 * Adds custom post capabilities. Only needs to be run once.
 * Hooks onto admin_init action.
 */
function add_event_caps() {
	$role = get_role( 'dp_policy' );

	$role->add_cap( 'edit_group' );
	$role->add_cap( 'edit_groups' );
	//$role->add_cap( 'edit_others_groups' );
	$role->add_cap( 'publish_groups' );
	$role->add_cap( 'read_group' );
	$role->add_cap( 'read_private_groups' );
	//$role->add_cap( 'delete_group' );
	//$role->add_cap( 'delete_groups' );
	//$role->add_cap( 'delete_others_groups' );
	$role->add_cap( 'level_1' );

	//$role->remove_cap( 'edit_others_pages' );
	//$role->remove_cap( 'publish_pages' );
	//$role->remove_cap( 'delete_page' );
	//$role->remove_cap( 'delete_pages' );
	//$role->remove_cap( 'delete_others_pages' );
	//$role->remove_cap( 'delete_published_pages' );
}
//add_action( 'admin_init', 'add_event_caps');

/**
 * Use this function to mass update post records
 * - Disable our custom post_name creation
 * - Disable Relevanssi and re-index afterward
 */
function modify_plan_slugs() {
	$user = wp_get_current_user();

	if($user->ID == 2)		//candace
	{
		$posts = get_posts(array('posts_per_page' => 500, 'post_type' => 'courses', 'offset' => 4250, 'orderby' => 'ID', 'order' => 'ASC'));

		foreach($posts as $post) {
			$name = explode('.', $post->post_title);
			$slug = str_replace('-', '', $name[0]);
			$slug = sanitize_title(strtolower($slug));
			$slug = wp_unique_post_slug($slug, $data['ID'], $data['post_status'], $data['post_type'], $data['post_parent']);

			if($post->$post_name !== $slug)
			{
				wp_update_post(array('ID' => $post->ID, 'post_name' => $slug));
			}
		}
	}
}
//add_action( 'admin_init', 'modify_plan_slugs');
