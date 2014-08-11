<?php 

/**
 * Template Name: Plans Single View
 */

$id = get_the_ID();
$years = get_the_terms( $id, 'aca_year');

foreach($years as $year)
	$aca_year = $year->name;
 
get_header(); ?>



<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<a class="dept-title-small" href="<?php echo site_url('/plan/plans/'); ?>">Plans</a>
					<a href="<?php echo the_permalink(); ?>"><h1 class="prog-title"><?php echo $aca_year.' '; the_title(); ?></h1></a>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="main-section" class = "main plans">
	<div class="container" id="wrap">
		<div class="row">
			<div class="pad-box">
				<div id="inset-content">
				<?php if(have_posts()): while (have_posts()) : the_post(); ?>
				
					<div class="row">
						<div class="col-xs-12">
							<div class="section-content">
								<?php the_content(); ?>
							</div>	
						</div>
					</div>
					
				<?php endwhile; else: ?>
				
					<p><?php _e('Sorry, no plans matched your criteria.'); ?></p>
					
				<?php endif; ?>
				</div>
			</div> <!-- end pad-box -->
		</div> <!-- end inset-content -->
	</div>
</div>

<?php get_footer(); ?>
