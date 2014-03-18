<?php /**
 * Template Name: About Page Template
 */ 
get_header(); ?>



<div class="row" id="subnav-wrap">

	<div class="container">

		<div class="row">

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

		<div class="section-content page-title-section">

			<a class="dept-title-small" href="<?php echo get_csun_archive('programs', $dept); ?>">CSUN Catalog</a>

				<a href="<?php echo the_permalink(); ?>"><h1 class="prog-title">About</h1></a>

		</div>

		</div>


	</div>

	</div>

</div>


<div id="main-section">

<div class="container" id="wrap">


	<!-- <div class="row">
				<div id="breadcrumbs-wrap" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<span><?php echo the_breadcrumb(); ?></span>
				</div>
			
	</div> -->



	<div class="row small-marg-top">




		<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 left-sidebar ">



		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 side-nav-col clearfix noborder">

			<ul class="side-nav">

				<li class="side-nav-active"><a href="<?php bloginfo( 'url' ); ?>">President's Message</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>">Introduction</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>">The California State University</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>">University Administration</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>">Academic Calendar</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>">Colleges, Degrees and Accreditation</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>">Undergraduate Admission Requirements</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>">Student Services</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>">Library</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>">Information Technology (IT)</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>">Academic Advisement</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>">Student Services Centers/EOP Satellites</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>">Special Programs</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>">Faculty and Administration</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>">Faculty and Administration Emeriti</a></li>


			</ul>
		</div>



		</div>


		<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">





		<?php 

		if(have_posts()): while (have_posts()) : the_post(); ?>





				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">

					<span class="section-title"><span><h2>About</h2></span></span>

					<p><?php the_content()?></p>

					

				</div>







		<?php endwhile; else: ?>

  			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

		<?php endif; ?>



		</div>

	</div>



	



</div>

</div>



<?php get_footer(); ?>