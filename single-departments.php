<?php 
/**
 * Template Name: Department Single View
 */ 
$dept = get_query_var( 'department_shortname' );

$deptterm = get_term_by( 'slug', $dept, 'department_shortname' );

$deptdesc = $deptterm->description;

get_header(); ?>


<div class="row" id="full-banner-inner">
	<div class="banner-overlay">
		<div class="container">
		</div>
		
	</div>
</div>



<div class="container" id="wrap">

	<?php if(have_posts()): while (have_posts()) : the_post(); ?>
	

	<div class="row">



			<!-- <div class=" container section-breadcrumb clearfix">
				<?php the_breadcrumb(); ?>
			</div> -->

	</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="section-content page-title-section">
			<a href="<?php the_permalink(); ?>"><h1 class="page-title"><?php the_title(); ?></h1></a>


	<div id="catalog-subnav">

		<ul class="clearfix">
			<li class="active"><a href="<?php the_permalink(); ?>">Overview</a><span class="subnav-arrow"></span></li>
			<li><a href="<?php bloginfo('url'); ?>/program/<?php echo $dept; ?>">Programs</a></li>
			<li><a href="#">Faculty</a></li>
			<li><a href="#">Courses</a></li>
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
