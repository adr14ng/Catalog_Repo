<?php 
/**
 * Template Name: Courses Single View
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
			<a class="dept-title-small" href="<?php echo get_csun_archive('courses', $dept); ?>">Courses</a>
				<a href="<?php echo get_csun_archive('departments', $dept); ?>"><h1 class="prog-title"><?php echo $deptdesc; ?></h1></a>
		</div>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div id="catalog-subnav">

		<ul class="clearfix">
			<li><a href="<?php echo get_csun_archive('departments', $dept); ?>">Overview</a></li>
			<li><a href="<?php echo get_csun_archive('programs', $dept); ?>">Programs</a></li>
			<li><a href="<?php echo get_csun_archive('faculty', $dept); ?>">Faculty</a></li>
			<li class="active"><a href="<?php echo get_csun_archive('courses', $dept); ?>">Courses</a><div class="arrow-wrap"><span class="subnav-arrow"></span></div></li>
		</ul>
		</div>
		</div>
	
	</div>
	</div>
</div>


<div id="main-section">
<div class="container" id="wrap">

	<div class="row">

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-title-wrap">

		<a href="<?php the_permalink(); ?>"><h2 class="inner-title dark"><span class="red">Course:</span> <?php the_title(); ?></h2></a>
		
		<div class="row">
			<div id="breadcrumbs-wrap" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<span><?php echo the_breadcrumb(); ?></span>
			</div>
			
		</div>

	</div>

<div class="pad-box">

	<div id="inset-content">


	<?php if(have_posts()): while (have_posts()) : the_post(); ?>
	


	<div class="row">

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="section-content">
			<span class="section-title"><span><h2>Course Info</h2></span></span> 
			<p><?php the_content(); ?></p>
		</div>		
	</div>
	</div>
</div>


<!-- 		<h1><?php the_title(); ?></h1>
		<p><?php the_content(); ?></p> -->

		<?php endwhile; else: ?>
  		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>

	</div> <!-- end inset-content -->

</div>
</div>

</div>







	






<?php get_footer(); ?>