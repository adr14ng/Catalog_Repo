<?php 
/**
 * Template Name: Programs Archive View
 */ 
$dept = get_query_var( 'department_shortname' );
$deptterm = get_term_by( 'slug', $dept, 'department_shortname' );
$deptdesc = $deptterm->description;

$levels = array('major', 'minor', 'master', 'doctorate', 'credential', 'authorization', 'certificate', 'honor', 'other');
$authorizations = false;

get_header(); ?>



<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<span class="dept-title-small">Programs</span>
					<a class="prog-title" href="<?php echo get_csun_archive('departments', $dept); ?>"><h1 class="prog-title"><?php echo $deptdesc; ?></h1></a>
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

<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="row">
			<div class="section-content">
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
					<span class="section-title"><span><h2>Programs</h2></span></span>

					<?php if(have_posts()) : ?>
						<?php foreach($levels as $level) :
							$query_programs = new WP_Query(array(
								'meta_key' => 'degree_type',
								'orderby' => 'meta_value title', 
								'order' => 'ASC',  
								'degree_level' => $level,
								'department_shortname' => $dept,
								'posts_per_page' => 1000,)); ?>
							<?php if($query_programs->have_posts()) : while($query_programs->have_posts()) : $query_programs->the_post(); ?>
								<?php 
								$degree = get_field('degree_type');
								$title = get_the_title();
								?>
					
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">
									<a class="csun-subhead" href="<?php the_permalink(); ?>">
										<h3 class="csun-subhead">
											<?php 
												if ($degree === 'credential' || $degree === 'Credential'){
													if (strpos($title, 'Credential') === FALSE)
														$title .= ' Credential';
												}
												else if ($degree === 'authorization' || $degree === 'Authorization'){
													if (strpos($title, 'Authorization') === FALSE)
														$title .= ' Authorization';
												}
												else if ($degree === 'certificate' || $degree === 'Certificate') {
													if (strpos($title, 'Certificate') === FALSE)
														$title .= ' Certificate';
												}
												else if ($degree === 'minor' || $degree === 'Minor'){
													$title = $degree.' in '.$title;
												}
												else if ($degree === 'honors' || $degree === 'Honors' ){
													$title = $title;
												}
												else
												{
													$title = $degree.', '.$title;
												}
												
												echo $title;
											?>
										</h3>
										<?php 
											$post_option=get_field('option_title');

											if(isset($post_option)&&$post_option!=='') {
												echo '<h4 class="pseudo-h5">'.$post_option.'</h4>';
												
												$title = $title.', '.$post_option;
											}
										?>
									</a>
									<?php the_excerpt(); ?>
								</div>
							<?php endwhile; endif; ?>
						<?php endforeach; ?>
						<?php wp_reset_query(); ?>
					<?php else: ?>
					
						<p><?php _e('There are currently no programs associated with '.$deptdesc.'.'); ?></p>
						
					<?php endif; ?>

				</div>
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 right-sidebar ">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix noborder">
						<span class="section-title"><span><h2>Contact</h2></span></span>
							<?php echo get_csun_contact($dept); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php get_footer(); ?>