<?php /**
 * Template Name: General Education Information Competence Template
 */ 


get_header(); ?>



<div class="row" id="subnav-wrap">

	<div class="container">

		<div class="row">

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

		<div class="section-content page-title-section">

			<a class="dept-title-small" href="<?php echo get_csun_archive('programs', $dept); ?>">Information Competence</a>

				<a href="<?php echo the_permalink(); ?>"><h1 class="prog-title">General Education</h1></a>

		</div>

		</div>


	</div>

	</div>

</div>


<div id="main-section">

<div class="container" id="wrap">

	<div class="row small-marg-top">

		<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 left-sidebar ">

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 side-nav-col clearfix noborder">

			<ul class="side-nav">

				<li><a href="<?php bloginfo( 'url' ); ?>/general-education-test/">GE Overview</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>/general-education-rules-test/">Rules</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>/general-education-pattern-modification-test/">Pattern Modifications</a></li>
				<li class="side-nav-active"><a href="<?php bloginfo( 'url' ); ?>/general-education/information-competence/">Information Competence (IC)</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>/general-education/courses/">Courses</a></li>

			</ul>
		</div>



		</div>


		<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">




		<?php 

		$terms = get_terms('general_education');

		foreach($terms as $term) :

			if($term->slug !== 'ic'):

				$query_policies = new WP_Query(array(
					'post_type' => 'courses', 
					'orderby' => 'title', 
					'order' => 'ASC',  
					'general_education' => 'ic+'.$term->slug)
				);

				if($query_policies->have_posts()) : 

				echo '<span class="section-title"><span><h2>' . $term->description .'</h2></span></span>';

				 while($query_policies->have_posts()) : $query_policies->the_post(); ?>
					<p class = "small-marg-bottom"><a href="<?php the_permalink();?>"/><?php the_title(); ?></a><p>

		<?php endwhile; endif; endif; endforeach;?>


		




<!-- 		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix small-marg-top">
			<span class="section-title"><span><h2>Basic Skills</h2></span></span>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">
				<h2 class="dark">Analytical Reading & Expository Writing</h2>
					<a href="#">Example Course Link One </a></br>
					<a href="#">Example Course Link Two </a></br>
					<a href="#">Example Course Link Three </a></br>
					<a href="#">Example Course Link Four </a></br>
					<a href="#">Example Course Link Five</a></br>
			</div>

		</div> -->



		</div>

	</div>

</div>

</div>

	<?php get_footer(); ?>