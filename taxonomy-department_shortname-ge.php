<?php /**
 * Template Name: General Courses Education Template
 */ 
// $dept = get_query_var( 'department_shortname' );

// $deptterm = get_term_by( 'slug', $dept, 'department_shortname' );

// $deptdesc = $deptterm->description;

get_header(); ?>



<div class="row" id="subnav-wrap">

	<div class="container">

		<div class="row">

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

		<div class="section-content page-title-section">

			<a class="dept-title-small" href="<?php echo get_csun_archive('programs', $dept); ?>">Courses</a>

				<a href="<?php echo the_permalink(); ?>"><h1 class="prog-title">General Education</h1></a>

		</div>

		</div>


	</div>

	</div>

</div>


<div id="main-section">

<div class="container" id="wrap">


	<!-- <div class="row">
				<div id="breadcrumbs-wrap" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<span><?php echo the_breadcrumb(); ?></span>
				</div>
			
	</div> -->



	<div class="row small-marg-top">




		<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 left-sidebar ">



		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 side-nav-col clearfix noborder">

			<ul class="side-nav">

				<li><a href="<?php bloginfo( 'url' ); ?>/general-education-test/">GE Overview</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>/general-education-rules-test/">Rules</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>/general-education-pattern-modification-test/">Pattern Modifications</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>/general-education/information-competence/">Information Competence (IC)</a></li>
				<li class="side-nav-active"><a href="<?php bloginfo( 'url' ); ?>/general-education/courses/">Courses</a></li>

			</ul>
		</div>



		</div>


		<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">





		<?php 

		$terms = get_terms('general_education');

		foreach($terms as $term) :

			if($term->slug !== 'ic'):


				echo '<span class="section-title"><span><h2>' . $term->description .'</h2></span></span>';

				$query_policies = new WP_Query(array('post_type' => 'courses', 'orderby' => 'title', 'order' => 'DESC',  'general_education' => $term->slug));

				if($query_policies->have_posts()) : while($query_policies->have_posts()) : $query_policies->the_post(); ?>
				
					<div class="small-marg-bottom"><a href="<?php the_permalink();?>"/><?php the_title(); ?></a></div>

			
		<?php endwhile; endif; endif; endforeach;?>


		<?php wp_reset_query(); ?> 


		</div>

	</div>



	



</div>

</div>



<?php get_footer(); ?>