<?php 
/**
 * Template Name: Programs Archive View
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
					<a class="dept-title-small" href="<?php echo get_csun_archive('programs', $dept); ?>">Programs</a>
					<a href="<?php echo get_csun_archive('departments', $dept); ?>"><h1 class="prog-title"><?php echo $deptdesc; ?></h1></a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div id="catalog-subnav">
					<ul class="clearfix">
						<li><a href="<?php echo get_csun_archive('departments', $dept); ?>">Overview</a></li>
						<li class="active"><a href="<?php echo get_csun_archive('programs', $dept); ?>">Programs</a><div class="arrow-wrap"><span class="subnav-arrow"></span></div></li>
						<li><a href="<?php echo get_csun_archive('faculty', $dept); ?>">Faculty</a></li>
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
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">

				<?php if(have_posts()): while (have_posts()) : the_post(); ?>

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">
							<a class="csun-subhead" href="<?php the_permalink(); ?>">
								<h3 class="csun-subhead">
									<?php 
									
										$degree = get_field('degree_type'); 
										$title = get_the_title(); 
										
										if ($degree === 'credential' || $degree === 'Credential'){
											if (strpos($title, 'Credential') === FALSE)
												$title .= ' Credential';
										}
										else if ($degree === 'certificate' || $degree === 'Certificate') {
											if (strpos($title, 'Certificate') === FALSE)
												$title .= ' Certificate';
										}
										else if ($degree === 'minor' || $degree === 'Minor'){
											$title = $degree.' in '.$title;
										}
										else{
											$title = $degree.', '.$title;
										}
										
										echo $title;
									?>
								</h3>
								<?php 
									$post_option=get_field('option_title');

									if(isset($post_option)&&$post_option!=='') {
										echo '<h5>'.$post_option.'</h5>';
									}
								?>
							</a>
							<p><?php the_excerpt(); ?></p>
							<a class="read-more" href="<?php the_permalink(); ?>">[ View Program ]</a>
						</div>

				<?php endwhile; else: ?>
				
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					
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


<?php get_footer(); ?>