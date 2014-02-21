<?php 
/**
 * Template Name: Courses Archive Template
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
			<a href="<?php the_permalink(); ?>"><h1 class="page-title">Faculty</h1></a>


	<div id="catalog-subnav">

		<ul class="clearfix">
			<li ><a href="<?php echo get_csun_archive('departments', $dept); ?>">Overview</a></li>
			<li><a href="<?php echo get_csun_archive('programs', $dept); ?>">Programs</a></li>
			<li><a href="<?php echo get_csun_archive('faculty', $dept); ?>">Faculty</a></li>
			<li class="active"><a href="<?php echo get_csun_archive('courses', $dept); ?>">Courses</a><span class="subnav-arrow"></span></li>
		</ul>
		</div>
	</div>
	</div>

</div>



<?php if(have_posts()): while (have_posts()) : the_post(); ?>


	<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>

	<p><?php the_content(); ?></p>



<?php endwhile; else: ?>
  		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>


</div>




<?php get_footer(); ?>