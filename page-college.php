<?php 
/**
 * Template Name: College Template
 */ 

get_header(); ?>

<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<span class="dept-title-small">College Overview</span>
					<h1 class="prog-title"><?php the_title() ?></h1>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="main-section" class = "main">
	<div class="container" id="wrap">

		<?php if(have_posts()): while (have_posts()) : the_post(); ?>
		
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="section-content">
							<span class="section-title"><span><h2>Departments and Programs</h2></span></span> 
							<?php 
								$dept=get_field('department_code');
								$deptterm = get_term_by( 'slug', $dept, 'department_shortname' );
								$deptdesc = $deptterm->description;
								
								$posts = get_posts( array( 'orderby' => 'title',
														   'order' => 'ASC',
														   'posts_per_page' => 20,
														   'department_shortname' => $dept,
														   'post_type' => 'departments'
												 ));
								
								foreach ( $posts as $post ) : setup_postdata( $post ); 
									$post_id = get_the_ID();
									$terms = wp_get_post_terms( $post_id, 'department_shortname');
									$url = get_csun_archive('departments', $terms[0]->slug);
								?>
									<p>
										<a href="<?php echo $url; ?>"><?php the_title(); ?></a>
									</p>
								<?php endforeach; 
								wp_reset_postdata();
							?>
						</div>
						<div class="section-content">
							<?php the_content(); ?>
						</div>
					<?php $values = get_field('college_courses');
					if ( $values != false) : ?>
						<div class="section-content">
							<span class="section-title"><span><h2>Courses</h2></span></span> 
							<?php the_field('college_courses'); ?>
						</div>
					<?php endif; ?>
					</div>
				</div>
			</div><!--/end col -->
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="section-content">
					<?php 
						$subject_line = "CSUN Catalog - ".$deptdesc;
						$subject_line = str_replace(' ', '%20', $subject_line);
						$body = 'Permalink : '.get_csun_archive('departments', $dept);
						$body = str_replace(' ', '%20', $body);
					?>
					<ul id="share-icons">
						<!-- <li><?php pdf_all_button(); ?></li> -->
						<li>
							<a class="no-line" alt="email" title="Email this page" 
								href='mailto:?subject=<?php echo $subject_line ?>&body=<?php echo $body; ?>' >
								<span class="stLarge glyphicon glyphicon glyphicon-envelope share-icon"></span>
							</a>
						</li>
						<li><a class="no-line" href="javascript:window.print()" alt="print" title="Print this page.">
								<span class="glyphicon glyphicon-print share-icon"></span>
						</a></li>
					</ul>
				</div>
				<div class="section-content">
					<span class="section-title"><span><h2>Contact</h2></span></span> 
					<?php the_field('contact'); ?>
				</div>
			</div> <!--/end col -->
		</div><!--/end row -->


			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no colleges matched your criteria.'); ?></p>
			<?php endif; ?>


	</div>
</div>


<?php get_footer(); ?>
