<?php



register_nav_menu( 'primary', __( 'Primary Menu', 'csuncatalognav' ) );


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
    //$base = "http://csuncatalog.com/kyle/";

    //renamed departments to overview as standard link
    if($post_type == 'departments'){   
        $post_type = 'overview';
    }

    //link format based on CSUN Types
    $url = $base . '/academics/'.$dept_name.'/'.$post_type;

    return $url;
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
	//Contact is in the department info
	$args=array(
		'post_type' => 'departments',
		'department_shortname' => $dept_name
	);
	$departments = get_posts( $args );
	
	$department = $departments[0];
	
	//acf get field
	$contact = get_field('contact', $department->ID);
	
	return $contact;
 }



?>