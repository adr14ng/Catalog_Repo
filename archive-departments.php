<?php 
/**
 * Template Name: Department Archive View
 */ 
$dept = get_query_var( 'department_shortname' );

get_header(); ?>



<div class="container" id="wrap">

	<?php if(have_posts()): while (have_posts()) : the_post(); ?>
	

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
			<li class="active"><a href="<?php echo get_csun_archive('departments', $dept); ?>">Department</a><span class="subnav-arrow"></span></li>
			<li><a href="<?php echo get_csun_archive('programs', $dept); ?>">Programs</a></li>
			<li><a href="<?php echo get_csun_archive('faculty', $dept); ?>">Faculty</a></li>
			<li><a href="<?php echo get_csun_archive('courses', $dept); ?>">Courses</a></li>
		</ul>
		</div>
	</div>
	</div>

</div>

<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
		<div class="section-content">
			<span class="section-title"><span><h2>Mission Statement</h2></span></span> 
			<p><?php the_field('mission_statement'); ?></p>
		</div>
	</div>

	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		<div class="section-content">
			<span class="section-title"><span><h2>Contact</h2></span></span> 
			<p><?php the_field('contact'); ?></p>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content">
					<span class="section-title"><span><h2>Careers</h2></span></span> 
					<p><?php the_field('careers'); ?></p>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content">
					<span class="section-title"><span><h2>Clubs and Societies</h2></span></span> 
					<p><?php the_field('student_orgs'); ?></p>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content">
					<span class="section-title"><span><h2>Overview</h2></span></span> 
					<p><?php the_content(); ?></p>
				</div>
			</div>
		</div>

	</div>

	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="section-content">
					<span class="section-title"><span><h2>Programs</h2></span></span> 
					<p>List out Programs</p>
				</div>
	</div>

</div>


	









<!-- 		<h1><?php the_title(); ?></h1>
		<p><?php the_content(); ?></p> -->

		<?php endwhile; else: ?>
  		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>


</div>



<?php get_footer(); ?>
