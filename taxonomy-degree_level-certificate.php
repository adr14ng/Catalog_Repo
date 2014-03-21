<?php /**
 * Template Name: Graduate Programs Certificate Template
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

			<a class="dept-title-small" href="<?php echo get_csun_archive('programs', $dept); ?>">Certificates</a>

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

				<li><a href="<?php bloginfo( 'url' ); ?>/graduate-programs/">Overview</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>/graduate-studies/credential-office/">Credential Office</a></li>
				<li class="indent"><a href="<?php bloginfo( 'url' ); ?>/graduate-studies/credential-office/credentials/">Credentials</a></li>
				<li class="side-nav-active"><a href="<?php bloginfo( 'url' ); ?>/graduate-studies/certificates/">Post-Baccalaureate University Certificate Programs</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>/graduate-studies/masters/">Masters</a></li>
				<li><a href="<?php bloginfo( 'url' ); ?>/graduate-studies/doctorates/">Doctorate</a></li>

			</ul>
		</div>



		</div>


		<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">


		<div class="row">

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix small-marg-bottom">
			<div class="content">
				<span class="section-title"><span><h2>Certificate Programs</h2></span></span>
				<p>University Certificate Programs are academic-credit Certificate Programs designed to provide an integrated and focused program of 
				study in selected academic fields. Designed to allow those in different majors to add an area of professional expertise to their Credentials, 
				University Certificates are added and updated to offer highly valued fields of study in the contemporary marketplace. They also allow 
				those with advanced degrees to add fields of study to their academic record, thus allowing them to enrich or shift their career options or 
				advance in their current professions.</p>

				<p>Those who complete University Certificate Programs successfully have the award of the University Certificate noted on their transcripts 
				and they are issued a formal University Certificate approved by the Office of Graduate Studies and signed by the University President. The 
				Post- Baccalaureate University Certificates currently offered are listed below.</p>

				<p>For detailed information on all of the following the Post-Baccalaureate Certificate Programs, visit 
				<a href="www.csun.edu/graduatestudies">www.csun.edu/graduatestudies</a>.<p>
			</div>
			</div>


			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">

			


				<div class="content">
					<span class="section-title"><span><h2>Certificates List</h2></span></span>
				

				<div class="dept-container content">
       	 			<?php if(have_posts()): while (have_posts()) : the_post(); ?>
            			<div class="dept-item ">
                		<a href="<?php the_permalink(); ?>"><?php the_title(); 
							$title = get_the_title();
							
							if (strpos($title, 'Certificate') === FALSE)
								echo ' Certificate'; $post_option=get_field('option_title');
							
							if(isset($post_option)&&$post_option!=='') {
								echo ' : '.$post_option;
							}
								?>
						</a>
            	</div>

        		<?php endwhile; else: ?>
  					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>

				</div>
				</div>


			
		</div>
		</div>

	</div>
	</div>

</div>
</div>



<?php get_footer(); ?>