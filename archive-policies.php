<?php /**

 * Template Name: Policies Archive View

 */ 

// $dept = get_query_var( 'department_shortname' );



// $deptterm = get_term_by( 'slug', $dept, 'department_shortname' );



// $deptdesc = $deptterm->description;

$perm = get_permalink();

$url = get_bloginfo( 'url' );

get_header(); ?>





<div class="row" id="full-banner-inner">

	<div class="banner-overlay">

		<div class="container">

			<h1 class="banner-title-inner"><span class="red">CSUN</span> UNIVERSITY CATALOG <span class="banner-title-small">2014-2015</span></h1>

		</div>

		

	</div>

</div>





<div class="row" id="subnav-wrap">



	<div class="container">



		<div class="row">



		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">



		<div class="section-content page-title-section">


			<?php if ($perm = $url.'/policies/alphabetical/' ) { ?>
				<a class="dept-title-small" href="<?php echo the_permalink(); ?>">Alphabetical</a>
			 <?php } else if ( $perm = $url.'/policies/appendix/' ) { ?>
				<a class="dept-title-small" href="<?php echo the_permalink(); ?>">Appendix</a>
			<?php } ?>

			



				<a href="<?php echo the_permalink(); ?>"><h1 class="prog-title">Policies</h1></a>



		</div>



		</div>





	</div>



	</div>



</div>





<div id="main-section">



<div class="container" id="wrap">







	<div class="row">



		<div class="section-content">







		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 left-sidebar ">







		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix noborder">



				<span class="section-title"><span><h2>Sort By</h2></span></span>



				<a href="<?php bloginfo( 'url' ); ?>/policies/alphabetical/">Alphabetical</a></br>

				<a href="<?php bloginfo( 'url' ); ?>/policies/appendix/">Appendix</a>

		</div>

		</div>

		<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">


		<?php 

		$order = get_query_var( 'orderby' );

		if(have_posts()): 



		if($order == 'policy_categories'):
			$terms = get_terms('policy_categories');

		foreach($terms as $term) :

			echo '<span class="section-title"><span><h2>' . $term->name .'</h2></span></span>';

			$query_policies = new WP_Query(array('post_type' => 'policies', 'orderby' => 'title', 'order' => 'DESC',  'policy_categories' => $term->slug));

			if($query_policies->have_posts()) : while($query_policies->have_posts()) : $query_policies->the_post(); ?>
			
				<div class="small-marg-bottom"><a href="<?php the_permalink();?>"/><?php the_title(); ?></a></div>

			<?php endwhile; endif; endforeach;?>


		<?php wp_reset_query(); ?> 

		<?php else:

			while (have_posts()) : the_post(); ?>


				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">

					<a href="<?php the_permalink(); ?>"><h3 class="csun-subhead"><?php the_title(); ?></h3></a>

					<p><?php the_excerpt(); ?></p>

					<!-- <p>Example content if needed.... Excerpt commented out.</p> -->

					<a class="read-more" href="<?php the_permalink(); ?>">[ View Policy ]</a>

				</div>


			<?php endwhile; ?>

	<?php endif; ?>

	<?php else: ?>


  			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>



		<?php endif; ?>







		</div>



		</div>



	</div>







	







</div>



</div>









<?php get_footer(); ?>