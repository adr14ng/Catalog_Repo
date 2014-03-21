<?php 
/**
 * Template Name: Department Single View
 */ 
$dept = get_query_var( 'department_shortname' );

$deptterm = get_term_by( 'slug', $dept, 'department_shortname' );

$deptdesc = $deptterm->description;

get_header(); ?>



<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="section-content page-title-section">
				<a class="dept-title-small" href="<?php the_permalink(); ?>">Department Overview</a>
				<a href="<?php echo get_csun_archive('departments', $dept); ?>"><h1 class="prog-title"><?php echo $deptdesc; ?></h1></a>
			</div>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div id="catalog-subnav">
					<ul class="clearfix">
						<li class="active"><a href="<?php echo get_csun_archive('departments', $dept); ?>">Overview</a><div class="arrow-wrap"><span class="subnav-arrow"></span></div></li>
						<li><a href="<?php echo get_csun_archive('programs', $dept); ?>">Programs</a></li>
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

	<?php if(have_posts()): while (have_posts()) : the_post(); ?>
	
<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
		<div class="section-content">
			<span class="section-title"><span><h2>Mission Statement</h2></span></span> 
			<?php the_field('mission_statement'); ?>
		</div>
	</div>

	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		<div class="section-content">
			<span class="section-title"><span><h2>Contact</h2></span></span> 
			<?php the_field('contact'); ?>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
	
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content">
					<span class="section-title"><span><h2>Academic Advisement</h2></span></span> 
					<?php the_field('academic_advisement'); ?>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content">
					<span class="section-title"><span><h2>Careers</h2></span></span> 
					<?php the_field('careers'); ?>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content">
					<span class="section-title"><span><h2>Accreditation</h2></span></span> 
					<?php the_field('accreditation'); ?>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content">
					<span class="section-title"><span><h2>Honors</h2></span></span> 
					<?php the_field('honors'); ?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content">
					<span class="section-title"><span><h2>Clubs and Societies</h2></span></span> 
					<?php the_field('student_orgs'); ?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>


</div>


		<?php endwhile; else: ?>
  		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>


</div>
</div>


<?php get_footer(); ?>
