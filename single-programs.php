<?php 

/**
 * Template Name: Programs Single View
 */

$dept = get_query_var( 'department_shortname' );


$deptterm = get_term_by( 'slug', $dept, 'department_shortname' );

$deptdesc = $deptterm->description;
 
get_header(); ?>

<div class="container" id="wrap">

	<?php if(have_posts()): while (have_posts()) : the_post(); ?>
	

<div class="row">
		<div class="mainbanner">
			<img src="<?php bloginfo('template_directory'); ?>/img/shatter_small.jpg">
		</div>

			<div class=" container section-breadcrumb clearfix">
				<?php the_breadcrumb(); ?>
			</div>
</div>


<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="section-content page-title-section">
			<a class="dept-title-small" href="<?php the_permalink(); ?>"><?php echo $deptdesc; ?></a>
			<a href="<?php the_permalink(); ?>"><h1 class="prog-title"><?php the_field('degree_type'); ?> in <?php the_title(); ?></h1></a>


	<div id="catalog-subnav">

		<ul class="clearfix">
			<li ><a href="<?php the_permalink(); ?>">Overview</a></li>
			<li class="active"><a href="#">Programs</a><span class="subnav-arrow"></span>
				<ul class="clearfix">
				</ul>

			</li>
			<li><a href="#">Faculty</a></li>
			<li><a href="#">Courses</a></li>
		</ul>
		</div>
	</div>
	</div>

</div>
	<div class="row">

	<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
		<div class="section-content">
			<span class="section-title"><span><h2>Program Requirements</h2></span></span> 
			<p><?php the_field('program_requirements'); ?></p>
		</div>		
	</div>

	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
		<div class="section-content col-sm-6 col-md-12 col-lg-12 ">
			<span class="section-title"><span><h2>Student Learning Outcomes</h2></span></span> 
			<p><?php the_field('slo'); ?></p>
		</div>

		<div class="section-content col-sm-6 col-md-12 col-lg-12">
			<span class="section-title"><span><h2>4 Year Plans</h2></span></span> 
			<p><?php the_field('four_year'); ?></p>
		</div>	

		<div class="section-content col-sm-6 col-md-12 col-lg-12">
			<span class="section-title"><span><h2>STAR Act</h2></span></span> 
			<p><?php the_field('star_act'); ?></p>
		</div>

		<div class="section-content col-sm-6 col-md-12 col-lg-12">
			<span class="section-title"><span><h2>Contact</h2></span></span> 
			<p><?php the_field('contact'); ?></p>
		</div>		

	</div>
</div>








</div>



<!-- 		<h1><?php the_title(); ?></h1>
		<p><?php the_content(); ?></p> -->

		<?php endwhile; else: ?>
  		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>





<?php get_footer(); ?>
