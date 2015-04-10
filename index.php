<?php get_header(); ?>


	<div class="row">
<div id="landing-section">
	<div class="container">
	<div class="row">
		<a class="landing-link" href="<?php echo site_url('/a-z/'); ?>">
		<div class="landing-item col-xs-4 clearfix">
			<div class="land-bg">
				<div class="landing-over clearfix">
					<img alt="" class="land-icon" src="<?php bloginfo('template_directory'); ?>/img/icon-xmarks.png">
					<div class="land-text">
						<h2 class="land-head">A to Z</h2>
						<span class="land-copy">An index to help you find your way.</span>
					</div>
				</div>
			</div>
		</div>
		</a>
		<a class="landing-link" href="<?php echo site_url('/about/'); ?>">
		<div class="landing-item col-xs-4 clearfix">
			<div class="land-bg">
			<div class="landing-over clearfix">
				<img alt="" class="land-icon" src="<?php bloginfo('template_directory'); ?>/img/icon-book.png">
				<div class="land-text">
					<h2 class="land-head">Introduction</h2>
					<span class="land-copy">Learn about California State University, Northridge.</span>
				</div>
			</div>
			<div class="land-arrow_bg"></div>
			</div>
		</div>
		</a>
		<a class="landing-link" href="<?php echo site_url('/resources/'); ?>">
		<div class="landing-item col-xs-4 clearfix">
			<div class="land-bg">
			<div class="landing-over clearfix">
				<img alt="" class="land-icon" src="<?php bloginfo('template_directory'); ?>/img/icon-sundial.png">
				<div class="land-text">
					<h2 class="land-head">Resources</h2>
					<span class="land-copy">Catalog Archives, Degree Planning Guides and more.</span>
				</div>
			</div>
			</div>
		</div>
		</a>
	</div>
</div>


</div>

<div id="main-section" class = "main">
<div class="container" id="wrap">


		<?php 
		$the_query = new WP_Query(array('post_type' => 'departments', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => 1000,)); 
		$num = $the_query->post_count;
		?>

	<div class="content">
		<span class="section-title"><span><h2>Departments & Programs</h2></span></span>
	</div>

	<div class="dept-container content">

		<?php // The Loop
			if( $the_query->have_posts() ) : while( $the_query->have_posts() ) : $the_query->the_post(); ?>

			<?php 
				$post_id = get_the_ID();
				$terms = wp_get_post_terms( $post_id, 'department_shortname');
				$url = get_csun_archive('departments', $terms[0]->slug);
			?>

			<a class="dept-item " href="<?php echo $url; ?>"><?php the_title(); ?></a>

		<?php endwhile;  endif;
			/* Restore original Post Data */
		wp_reset_postdata(); ?>		
</div>





	</div>

</div>

<?php get_footer(); ?>