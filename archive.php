<?php 

/**
 * Template Name: Courses Archive Template
 */ 

$type = ucwords(get_post_type());

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
			<div class="section-content">
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">

				<?php if(have_posts()): while (have_posts()) : the_post(); ?>

					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">
						<a href="<?php the_permalink(); ?>"><h3 class="csun-subhead"><?php the_title(); ?></h3></a>
						<p><?php the_excerpt(); ?></p>
						<a class="read-more" href="<?php the_permalink(); ?>">[ View <?php echo $type; ?> ]</a>
					</div>
					
				<?php endwhile; else: ?>

					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

				<?php endif; ?>
				
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>