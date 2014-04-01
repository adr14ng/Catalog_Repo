<?php get_header(); ?>



<div id="landing-section">
	<div class="container">
	<div class="row">
		<a href="<?php echo site_url('/site-map/'); ?>">
		<div class="landing-item col-xs-12 col-sm-4 col-md-4 col-lg-4 clearfix">
			<img class="land-bg" src="<?php bloginfo('template_directory'); ?>/img/landing-bg.png">
			<div class="landing-over clearfix">
				<img class="land-bg" src="<?php bloginfo('template_directory'); ?>/img/icon-xmarks.png">
				<h4 class="land-head">Your Catalog Guide</h4>
				<span class="land-copy">A site map to help you find your way.</span>
			</div>
		</div>
		</a>
		<a href="<?php echo site_url('/about/'); ?>">
		<div class="landing-item col-xs-12 col-sm-4 col-md-4 col-lg-4 clearfix">
			<img class="land-bg" src="<?php bloginfo('template_directory'); ?>/img/landing-bg.png">
			<div class="landing-over clearfix">
				<img class="land-bg" src="<?php bloginfo('template_directory'); ?>/img/icon-book.png">
				<h4 class="land-head">Explore CSUN</h4>
				<span class="land-copy">See whats going on at CSUN.</span>
			</div>
		</div>
		</a>
		<a href="<?php echo site_url('/resources/'); ?>">
		<div class="landing-item col-xs-12 col-sm-4 col-md-4 col-lg-4 clearfix">
			<img class="land-bg" src="<?php bloginfo('template_directory'); ?>/img/landing-bg.png">
			<div class="landing-over clearfix">
				<img class="land-bg" src="<?php bloginfo('template_directory'); ?>/img/icon-sundial.png">
				<h4 class="land-head">Catalog Resources</h4>
				<span class="land-copy">Downloads, archives and other similar information accessed here.</span>
			</div>
		</div>
		</a>
	</div>
</div>



</div>

<div id="main-section" class = "main">
<div class="container" id="wrap">

	<div class="content">
		<span class="section-title"><span><h2>Departments & Programs</h2></span></span>
	</div>

	<div class="dept-container content">





		<?php 
			// Query my custom post type
		$the_query = new WP_Query(array('post_type' => 'departments', 'orderby' => 'title', 'order' => 'ASC')); ?>


		<?php // The Loop
			if( $the_query->have_posts() ) : while( $the_query->have_posts() ) : $the_query->the_post(); ?>

		<div class="dept-item "> <!-- col-xs-12 col-sm-6 col-md-4 col-lg-3 -->

			<?php 
			$post_id = get_the_ID();

			$terms = wp_get_post_terms( $post_id, 'department_shortname');

			$url = get_csun_archive('departments', $terms[0]->slug);

			?>

			<a href="<?php echo $url; ?>"><?php the_title(); ?></a>
		</div>





		<?php endwhile;  endif;
			/* Restore original Post Data */
		wp_reset_postdata(); ?>

		
</div>





	</div>

</div>

<?php get_footer(); ?>