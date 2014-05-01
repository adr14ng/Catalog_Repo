<?php 
/**
 * Template Name: General Education Template
 */ 

get_header(); ?>

<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<a class="dept-title-small" href="<?php bloginfo( 'url' ); ?>/general-education/">General Education</a>
					<h1 class="prog-title"><?php the_title(); ?></h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="row small-marg-top">
			<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 left-sidebar ">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 side-nav-col clearfix noborder">
				<?php 
					$args = array(
							'theme_location' => 'ge-menu',
							'container' => false,
							'menu_class' => 'side-nav',
							'fallback_cb' => false,
							
						);
					
					wp_nav_menu( $args ); 
					?>
				</div>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
			<?php if(have_posts()): while (have_posts()) : the_post(); ?>
			
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">
					<?php the_content()?>
				</div>
					
			<?php endwhile; else: ?>

				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

			<?php endif; ?>
			</div>
		</div>
	</div>
</div>



<?php get_footer(); ?>