<?php 
/**
 * Template Name: Single Faculty
 */ 

$dept = get_query_var( 'department_shortname' );

get_header(); ?>


<div class="container" id="wrap">

	
	

	<div class="row">

		<div class="mainbanner">
			<img src="<?php bloginfo('template_directory'); ?>/img/shatter_small.jpg">
		</div>


			<div class=" container section-breadcrumb clearfix">
				<?php the_breadcrumb(); ?>
			</div>

	</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="section-content page-title-section">
			<a href="<?php the_permalink(); ?>"><h1 class="page-title">Single Faculty</h1></a>


	<div id="catalog-subnav">

		<ul class="clearfix">
			<li ><a href="<?php the_permalink(); ?>">Overview</a></li>
			<li><a href="#">Programs</a>
				<ul class="clearfix">

				<?php 

				// $categories = get_the_category();
				// $category_id = $categories[0]->cat_ID;

				

				$args = array(
					'post_type' => 'programs',
					'order' => 'ASC',
					'department_shortname' => $dept				
				);


				$the_query = new WP_Query( $args ); ?>


				<?php // The Loop
				if( $the_query->have_posts() ) : while( $the_query->have_posts() ) : $the_query->the_post(); ?>

					<li><a href="<?php the_permalink(); ?>"><?php the_field('degree_type'); ?> in <?php the_title(); ?></a></li>
					<!-- , <?php the_field('option_title'); ?> -->
					
					<?php endwhile;  endif;
					/* Restore original Post Data */
					wp_reset_postdata(); ?>

				</ul>

			</li>
			<li class="active"><a href="#">Faculty</a><span class="subnav-arrow"></span></li>
			<li><a href="#">Courses</a></li>
		</ul>
		</div>
	</div>
	</div>

</div>










<?php if(have_posts()): while (have_posts()) : the_post(); ?>


	<h2><?php the_title(); ?></h2>

	<p><?php the_content(); ?></p>



<?php endwhile; else: ?>
  		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>


</div>




<?php get_footer(); ?>