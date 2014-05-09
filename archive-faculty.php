<?php 
/**
 * Template Name: Faculty Archive Template
 */ 

$dept = get_query_var( 'department_shortname' );
$deptterm = get_term_by( 'slug', $dept, 'department_shortname' );
$deptdesc = $deptterm->description;

//Make ascending by title
global $query_string;
query_posts( $query_string . '&orderby=title&order=ASC' );

get_header(); ?>

<?php if (!($dept === 'emeriti' || $dept === '')): ?>

	<div class="row" id="subnav-wrap">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="section-content page-title-section">
						<a class="dept-title-small" href="<?php the_permalink(); ?>">Faculty</a>
						<a href="<?php echo get_csun_archive('departments', $dept); ?>"><h1 class="prog-title"><?php echo $deptdesc; ?></h1></a>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div id="catalog-subnav">
						<ul class="clearfix">
							<li><a href="<?php echo get_csun_archive('departments', $dept); ?>">Overview</a></li>
							<li><a href="<?php echo get_csun_archive('programs', $dept); ?>">Programs</a></li>
							<li class="active"><a href="<?php echo get_csun_archive('faculty', $dept); ?>">Faculty</a><div class="arrow-wrap"><span class="subnav-arrow"></span></div></li>
							<li><a href="<?php echo get_csun_archive('courses', $dept); ?>">Courses</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="main-section" class = "main">
		<div class="container" id="wrap">
			<div class="row">
				<div class="section-content">
					<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
						<span class="section-title"><span><h2>Current Faculty</h2></span></span>
						
					<?php if(have_posts()): while (have_posts()) : the_post(); ?>

						<?php if( strpos(get_the_term_list(  $post->ID, 'department_shortname', '', ', '), 'Emeriti') === FALSE): ?>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">
								<a class="csun-subhead" href="<?php the_csun_permalink(); ?>"><h3 class="csun-subhead"><?php the_title(); ?></h3></a>
								<p><?php the_excerpt(); ?></p>
								<a class="read-more" href="<?php the_permalink(); ?>">[ View Faculty Member ]</a>
							</div>
						<?php endif; ?>

					<?php endwhile; else: ?>
					
						<p><?php _e('There are currently no faculty associated with '.$deptdesc.'.'); ?></p>
						
					<?php endif; ?>

						</br></br></br>

						<span class="section-title"><span><h2>Emeritus Faculty</h2></span></span>

					<?php if(have_posts()): while (have_posts()) : the_post(); ?>

						<?php if( strpos(get_the_term_list(  $post->ID, 'department_shortname', '', ', '), 'Emeriti') !== FALSE): ?>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">
								<a class="csun-subhead" href="<?php the_permalink(); ?>"><h3 class="csun-subhead"><?php the_title(); ?></h3></a>
								<p><?php the_excerpt(); ?></p>
								<a class="read-more" href="<?php the_permalink(); ?>">[ View Faculty Member ]</a>
							</div>
						<?php endif; ?>

					<?php endwhile; else: ?>
					
						<p><?php _e('There are currently no emeritus faculty associated with '.$deptdesc.'.'); ?></p>
						
					<?php endif; ?>

					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 right-sidebar ">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix noborder">
							<span class="section-title"><span><h2>Contact</h2></span></span>
							<ul class="sidebar-list">
								<?php echo get_csun_contact($dept); ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php elseif ($dept === 'emeriti'): ?>

	<div class="row" id="subnav-wrap">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="section-content page-title-section">
						<span class="dept-title-small">Faculty</span>
						<h1 class="prog-title">Emeritus Faculty</h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="main-section"  class = "main">
		<div class="container" id="wrap">
			<div class="row">
				<div class="section-content">
					<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">

					<?php if(have_posts()): while (have_posts()) : the_post(); ?>

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">
							<a class="csun-subhead" href="<?php the_permalink(); ?>"><h3 class="csun-subhead"><?php the_title(); ?></h3></a>
							<p><?php the_excerpt(); ?></p>
							<a class="read-more" href="<?php the_permalink(); ?>">[ View Faculty Member ]</a>
						</div>

					<?php endwhile; else: ?>
					
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
						
					<?php endif; ?>

					</div>
				</div>
			</div>
		</div>
	</div>

<?php else: ?>

	<div class="row" id="subnav-wrap">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="section-content page-title-section">
						<span class="dept-title-small">Faculty</span>
						<h1 class="prog-title">Faculty and Adminstration</h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="main-section"  class = "main">
		<div class="container" id="wrap">
			<div class="row">
				<div class="section-content">
					<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">

					<?php if(have_posts()): while (have_posts()) : the_post(); ?>
					
						<?php if( strpos(get_the_term_list(  $post->ID, 'department_shortname', '', ', '), 'Emeriti') === FALSE): ?>

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">
								<a class="csun-subhead" href="<?php the_permalink(); ?>"><h3 class="csun-subhead"><?php the_title(); ?></h3></a>
								<p><?php the_excerpt(); ?></p>
								<a class="read-more" href="<?php the_permalink(); ?>">[ View Faculty Member ]</a>
							</div>
						
						<?php endif; ?>

					<?php endwhile; else: ?>
					
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
						
					<?php endif; ?>

					</div>
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>

<?php get_footer(); ?>
