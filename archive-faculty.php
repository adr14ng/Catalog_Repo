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


<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<!-- <small></small> -->
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

<div id="main-section">
	<div class="container" id="wrap">

		<div class="row">
				<div class="section-content">
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 left-sidebar ">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix noborder">
							<span class="section-title"><span><h2>Contact</h2></span></span>
							<ul class="sidebar-list">
								<?php echo get_csun_contact($dept); ?>
							</ul>
						</div>
					</div>
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
					<span class="section-title"><span><h2>Current Faculty</h2></span></span>
					
				<?php if(have_posts()): while (have_posts()) : the_post(); ?>

					<?php if( strpos(get_the_term_list(  $post->ID, 'department_shortname', '', ', '), 'Emeriti') === FALSE): ?>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">
							<a href="<?php the_csun_permalink(); ?>"><h3 class="csun-subhead"><?php the_title(); ?></h3></a>
							<p><?php the_excerpt(); ?></p>
							<a class="read-more" href="<?php the_permalink(); ?>">[ View Faculty Member ]</a>
						</div>
					<?php endif; ?>

				<?php endwhile; else: ?>
				
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					
				<?php endif; ?>

					</br></br></br>

					<span class="section-title"><span><h2>Emeritus Faculty</h2></span></span>

				<?php if(have_posts()): while (have_posts()) : the_post(); ?>

					<?php if( strpos(get_the_term_list(  $post->ID, 'department_shortname', '', ', '), 'Emeriti') !== FALSE): ?>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">
							<a href="<?php the_permalink(); ?>"><h3 class="csun-subhead"><?php the_title(); ?></h3></a>
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

<?php get_footer(); ?>
