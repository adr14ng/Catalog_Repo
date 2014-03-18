<?php 
/**
 * Template Name: Default Single View
 */ 

get_header(); ?>

<div class="row" id="full-banner-inner">
	<div class="banner-overlay">
		<div class="container">
			<h1 class="banner-title-inner"><span class="red">CSUN</span> UNIVERSITY CATALOG <span class="banner-title-small">2014-2015</span></h1>
		</div>
	</div>
</div>

<div id="main-section">
	<div class="container" id="wrap">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-title-wrap">
				<a href="<?php the_permalink(); ?>"><h2 class="inner-title dark"><?php the_title(); ?></h2></a>
			</div>

			<div class="pad-box">
				<div id="inset-content">
				<?php if(have_posts()): while (have_posts()) : the_post(); ?>
				
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="section-content">
								<p><?php the_content(); ?></p>
							</div>		
						</div>
					</div>
			
				<?php endwhile; else: ?>
			
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				
				<?php endif; ?>
				</div><!-- end inset-content -->
			</div> 
		</div>
	</div>
</div>















	













<?php get_footer(); ?>