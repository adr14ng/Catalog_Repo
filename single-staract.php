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
					<a class="dept-title-small" href="<?php echo site_url('/plan/star-act/'); ?>">STAR Act</a>
					<h1 class="prog-title"><?php echo $aca_year.' '; the_title(); ?></h1>
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
								<?php
								$programs = get_field('degree_planning_guides');
								if($programs) :
								
									$programs = $programs[0];
									//get plans
									
									$name = program_name($programs->ID);
								?>
								<a class="planning-degree-title" href="<?php echo get_permalink($programs->ID); ?>">
									<h2><?php echo $name; ?>
									
										<?php $post_option=get_field('option_title', $programs->ID);
										if(isset($post_option)&&$post_option!=='') : ?>
											<span class="option-title"><?php echo $post_option; ?> Option</span>
										<?php endif; ?>
									</h2>
								</a>
								<?php endif; ?>
								<p><?php the_content(); ?></p>
							</div>	
						</div>
					</div>
					
				<?php endwhile; else: ?>
				
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					
				<?php endif; ?>
				</div>
			</div> <!-- end pad-box -->
		</div> <!-- end inset-content -->
	</div>
</div>

<?php get_footer(); ?>
