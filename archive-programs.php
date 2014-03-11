<?php 
/**
 * Template Name: Programs Archive View
 */ 
$dept = get_query_var( 'department_shortname' );

$deptterm = get_term_by( 'slug', $dept, 'department_shortname' );

$deptdesc = $deptterm->description;

get_header(); ?>


<div class="row" id="full-banner-inner">
	<div class="banner-overlay">
		<div class="container">
			<h1 class="banner-title-inner"><span class="red">CSUN</span> UNIVERSITY CATALOG <span class="banner-title-small">2014-2015</span></h1>
		</div>
		
	</div>
</div>


<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="section-content page-title-section">
			<a class="dept-title-small" href="<?php echo get_csun_archive('programs', $dept); ?>">Programs</a>
				<a href="<?php echo get_csun_archive('departments', $dept); ?>"><h1 class="prog-title"><?php echo $deptdesc; ?></h1></a>
		</div>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div id="catalog-subnav">

		<ul class="clearfix">
			<li><a href="<?php echo get_csun_archive('departments', $dept); ?>">Overview</a></li>
			<li class="active"><a href="<?php echo get_csun_archive('programs', $dept); ?>">Programs</a><div class="arrow-wrap"><span class="subnav-arrow"></span></div></li>
			<li><a href="<?php echo get_csun_archive('faculty', $dept); ?>">Faculty</a></li>
			<li><a href="<?php echo get_csun_archive('courses', $dept); ?>">Courses</a></li>
		</ul>
		</div>
		</div>

	
	</div>
	</div>

</div>

<div id="main-section">
<div class="container" id="wrap">

	<div class="row">
		<div class="section-content">

		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 left-sidebar ">

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix noborder">
				<span class="section-title"><span><h2>Contact</h2></span></span>
			<ul class="sidebar-list">
				<?php get_csun_contact($dept); ?>
			</ul>
			</div>

		</div>


		<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">


		<?php if(have_posts()): while (have_posts()) : the_post(); ?>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">

					<a href="<?php the_permalink(); ?>"><h3 class="csun-subhead"><?php the_field('degree_type'); ?> in <?php the_title(); ?></h3></a>
					<!-- , <?php the_field('option_title'); ?> -->
					<p><?php the_excerpt(); ?></p>
					<a class="read-more" href="<?php the_permalink(); ?>">[ View Program ]</a>
					
				</div>



		<?php endwhile; else: ?>
  			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>

		</div>
		</div>
	</div>

	









<!-- 		<h1><?php the_title(); ?></h1>
		<p><?php the_content(); ?></p> -->

		


</div>
</div>


<?php get_footer(); ?>