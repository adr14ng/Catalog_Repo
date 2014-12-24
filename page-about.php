<?php /**
 * Template Name: About Page Template
 */ 
get_header(); ?>

<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<a class="dept-title-small" href="<?php echo site_url('/about/'); ?>">About</a>
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
							'theme_location' => 'about-menu',
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

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
					<?php the_content()?>
					<?php $related = get_field('related_pols');
						if($related != false) : ?>
						<div id="related-pols">
							<h2 class="section-header">Related Topics</h2>
							<?php foreach($related as $post) : ?>
								<?php setup_postdata($post); ?>
								<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
							<?php endforeach; ?>
							<?php wp_reset_postdata(); ?>
						</div>
						<?php endif; ?>
				</div>

			<?php endwhile; else: ?>

				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

			<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>