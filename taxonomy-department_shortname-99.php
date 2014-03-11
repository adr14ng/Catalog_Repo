<?php /**
 * Template Name: General Education Template
 */ 
// $dept = get_query_var( 'department_shortname' );

// $deptterm = get_term_by( 'slug', $dept, 'department_shortname' );

// $deptdesc = $deptterm->description;

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
			<!-- <a class="dept-title-small" href="<?php the_permalink(); ?>">Programs</a> -->
				<a href="<?php echo get_csun_archive('policies', $dept); ?>"><h1 class="prog-title"><span class="dark">The Template Works!</span></h1></a>

	</div>
	</div>
	</div>
	</div>

</div>


<div id="main-section">
<div class="container" id="wrap">


</div>
</div>




<?php get_footer(); ?>