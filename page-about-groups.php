<?php /**
 * Template Name: About Page - Groups Template
 */ 
get_header(); 

$terms = get_the_terms($post->ID, 'group_type');
$term = reset($terms);

?>

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
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
					<?php //the_content()?>
					
					<?php
					$query_posts = new WP_Query(array(
							'post_type' => 'groups', 
							'orderby' => 'title', 
							'order' => 'ASC',
							'posts_per_page' => 1000,
							'group_type' => $term->slug,
						)
					);

					?>
					
					<?php if($query_posts->have_posts()) : ?>
						<?php while($query_posts->have_posts()) : $query_posts->the_post(); ?>
						
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">
							<a class="csun-subhead" href="<?php the_permalink(); ?>"><h2 class="csun-subhead pseudo-h3"><?php the_title(); ?></h2></a>
							<?php the_excerpt(); ?>
						</div>
						
						<?php endwhile; ?>
					<?php endif; ?>
					<?php wp_reset_query(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>