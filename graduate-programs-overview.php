<?php /**
 * Template Name: Graduate Programs Overview Template
 */ 
// $dept = get_query_var( 'department_shortname' );

// $deptterm = get_term_by( 'slug', $dept, 'department_shortname' );

// $deptdesc = $deptterm->description;

get_header(); ?>



<div class="row" id="subnav-wrap">

	<div class="container">

		<div class="row">

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

		<div class="section-content page-title-section">

			<a class="dept-title-small" href="<?php echo get_csun_archive('programs', $dept); ?>">Overview</a>

				<a href="<?php echo the_permalink(); ?>"><h1 class="prog-title">Graduate Programs</h1></a>

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

				<li class="side-nav-active"><a href="<?php bloginfo( 'url' ); ?>/graduate-programs/">Overview</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>/graduate-studies/credential-office/credentials/">Credential Office</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>/graduate-studies/certificates/">Post-Baccalaureate University Certificate Programs</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>/graduate-studies/masters/">Masters</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>/graduate-studies/doctorates/">Doctorate</a></li>

			</ul>
		</div>



		</div>


		<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix small-marg-bottom">
			<div class="content">
				<span class="section-title"><span><h2>Certificate Programs</h2></span></span>
				<?php $values = get_the_content();
				if ( $values != false ) { ?>
						<p><?php the_content(); ?></p>
					
				<?php } else { ?>
				<p>No Content, here's some Lorem ipsum!</p>
				<?php } ?>
			</div>
			</div>




		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix small-marg-bottom">
		<?php 

		if(have_posts()): while (have_posts()) : the_post(); ?>





				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">

					<span class="section-title"><span><h2>GE Overview</h2></span></span>

					<p><?php the_content()?></p>

					

				</div>







		<?php endwhile; else: ?>

  			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

		<?php endif; ?>

		</div>

		</div>

	</div>



	



</div>

</div>



<?php get_footer(); ?>