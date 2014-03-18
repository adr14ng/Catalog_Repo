<?php 

/**
 * Template Name: Policies Single View
 */

$id = get_the_ID();

 
get_header(); ?>



<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="section-content page-title-section">
			<a class="dept-title-small" href="<?php echo site_url('/policies/appendix/'); ?>">Policies</a>
				<a href="<?php echo the_permalink(); ?>"><h1 class="prog-title"><?php the_title(); ?></h1></a>
		</div>
		</div>
	
	</div>
	</div>

</div>




<div id="main-section">
<div class="container" id="wrap">

	<div class="row">

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-title-wrap">

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

	<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
		<div class="section-content">
			<span class="section-title"><span><h2>Policy Info</h2></span></span> 
			<p><?php the_content(); ?></p>
			<p><?php the_terms( $id, 'policy_keywords', 'Keywords : ', ', ') ?></p>
		</div>	

				

	</div>
	</div>
</div>

</div> <!-- end pad-box -->










<!-- 		<h1><?php the_title(); ?></h1>
		<p><?php the_content(); ?></p> -->

		<?php endwhile; else: ?>
  		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>

	</div> <!-- end inset-content -->

</div>
</div>

<?php get_footer(); ?>
