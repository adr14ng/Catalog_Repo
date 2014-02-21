<?php 
/**
 * Template Name: Programs Archive View
 */ 
$dept = get_query_var( 'department_shortname' );

get_header(); ?>



<div class="container" id="wrap">

	

	<div class="row">

		<div class="mainbanner">
			<img src="<?php bloginfo('template_directory'); ?>/img/shatter_small.jpg">
		</div>


	</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="section-content page-title-section">
			<a href="<?php the_permalink(); ?>"><h1 class="page-title"><?php the_title(); ?></h1></a>


		<div id="catalog-subnav">

		<ul class="clearfix">
			<li><a href="<?php echo get_csun_archive('departments', $dept); ?>">Department</a></li>
			<li class="active"><a href="<?php echo get_csun_archive('programs', $dept); ?>">Programs</a><span class="subnav-arrow"></span></li>
			<li><a href="<?php echo get_csun_archive('faculty', $dept); ?>">Faculty</a></li>
			<li><a href="<?php echo get_csun_archive('courses', $dept); ?>">Courses</a></li>
		</ul>
		</div>
	</div>
	</div>

</div>


	<div class="row">
		<div class="section-content">

		<?php if(have_posts()): while (have_posts()) : the_post(); ?>


					<h2><a href="<?php the_permalink(); ?>"><?php the_field('degree_type'); ?> in <?php the_title(); ?></a></h2>
					<!-- , <?php the_field('option_title'); ?> -->




		<?php endwhile; else: ?>
  			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>

		</div>
	</div>

	









<!-- 		<h1><?php the_title(); ?></h1>
		<p><?php the_content(); ?></p> -->

		


</div>



<?php get_footer(); ?>