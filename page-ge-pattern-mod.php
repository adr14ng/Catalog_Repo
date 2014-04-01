<?php 
/**
 * Template Name: General Education Pattern Modification Template
 */ 


get_header(); ?>

<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<a class="dept-title-small" href="<?php bloginfo( 'url' ); ?>/general-education/">General Education</a>
					<h1 class="prog-title">Pattern Modification</h1>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="row small-marg-top">
			<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 left-sidebar ">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 side-nav-col clearfix noborder">
					<ul class="side-nav">
						<li><a href="<?php bloginfo( 'url' ); ?>/general-education/">GE Overview</a></li>
						<li><a href="<?php bloginfo( 'url' ); ?>/general-education/rules/">Rules</a></li>
						<li class="side-nav-active"><a href="<?php bloginfo( 'url' ); ?>/general-education/pattern-modifications/">Pattern Modifications</a></li>
						<li><a href="<?php bloginfo( 'url' ); ?>/general-education/information-competence/">Information Competence (IC)</a></li>
						<li><a href="<?php bloginfo( 'url' ); ?>/general-education/courses/">Courses</a></li>
					</ul>
				</div>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
			<?php if(have_posts()): while (have_posts()) : the_post(); ?>
			
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">
					<span class="section-title"><span><h2>Pattern Modifications</h2></span></span>
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