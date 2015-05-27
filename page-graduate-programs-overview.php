<?php 
/**
 * Template Name: Graduate Programs Template
 */ 

get_header(); ?>

<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<a class="dept-title-small" href="<?php bloginfo( 'url' ); ?>/graduate-studies/">Graduate Programs</a>
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
							'theme_location' => 'rgs-menu',
							'container' => false,
							'menu_class' => 'side-nav',
							'fallback_cb' => false,
							
						);
					
					wp_nav_menu( $args ); 
					?>
				</div>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix small-marg-bottom">
				<?php if(have_posts()): while (have_posts()) : the_post(); ?>
				
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
						<?php the_content()?>
					</div>

				<?php endwhile; else: ?>

					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

				<?php endif; ?>
				<div class="section-content">
					<span class="section-title"><span><h2>Graduate Studies Policies and Procedures</h2></span></span>
					<?php 
						$args = array(
							'post_type' => 'policies',
							'orderby' => 'title',
							'order' => 'ASC',
							'tax_query' => array(
								array(
									'taxonomy' => 'policy_categories',
									'field' => 'slug',
									'terms' => 'graduate-policies',
								),
							),
							'posts_per_page' => -1,
						);
						
						$grad_policies = new WP_Query($args);
						if($grad_policies->have_posts()) : while($grad_policies->have_posts()) : $grad_policies->the_post(); ?>
						
						<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
						
						<?php endwhile; endif;?>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>



<?php get_footer(); ?>