<?php get_header(); ?>

<div class="row" id="full-banner">
	<div class="banner-overlay">
		<div class="container">
			<h1 class="banner-title"><span class="banner-title-big">CSUN</span></br>UNIVERSITY CATALOG <span class="banner-title-small">2014-2015</span></h1>
		</div>
		
	</div>
</div>

<div id="landing-section">
	<div class="container">
	<div class="row">
		<div class="landing-item col-xs-12 col-sm-4 col-md-4 col-lg-4 clearfix">
			<img class="land-bg" src="<?php bloginfo('template_directory'); ?>/img/landing-bg.png">
			<div class="landing-over clearfix">
				<img class="land-bg" src="<?php bloginfo('template_directory'); ?>/img/icon-xmarks.png">
				<h4 class="land-head">Your Catalog Guide</h4>
				<span class="land-copy">For new students, helps to get them pointed in the right direction.</span>
			</div>
		</div>
		<div class="landing-item col-xs-12 col-sm-4 col-md-4 col-lg-4 clearfix">
			<img class="land-bg" src="<?php bloginfo('template_directory'); ?>/img/landing-bg.png">
			<div class="landing-over clearfix">
				<img class="land-bg" src="<?php bloginfo('template_directory'); ?>/img/icon-book.png">
				<h4 class="land-head">Explore CSUN</h4>
				<span class="land-copy">See whats going on at CSUN.</span>
			</div>
		</div>
		<div class="landing-item col-xs-12 col-sm-4 col-md-4 col-lg-4 clearfix">
			<img class="land-bg" src="<?php bloginfo('template_directory'); ?>/img/landing-bg.png">
			<div class="landing-over clearfix">
				<img class="land-bg" src="<?php bloginfo('template_directory'); ?>/img/icon-sundial.png">
				<h4 class="land-head">Catalog Resources</h4>
				<span class="land-copy">Downloads, archives and other similar information accessed here.</span>
			</div>
		</div>
	</div>
</div>



</div>

<div id="main-section">
<div class="container" id="wrap">

	<div class="content">
		<span class="section-title"><span><h2>Departments List</h2></span></span>
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