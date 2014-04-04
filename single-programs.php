<?php 

/**
 * Template Name: Programs Single View
 */



$dept = get_query_var( 'department_shortname' );


$deptterm = get_term_by( 'slug', $dept, 'department_shortname' );

$deptdesc = $deptterm->description;

 
get_header(); ?>


<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<a class="dept-title-small" href="<?php echo get_csun_archive('programs', $dept); ?>">Programs</a>
					<a href="<?php echo get_csun_archive('departments', $dept); ?>"><h1 class="prog-title"><?php echo $deptdesc; ?><!-- : <span class="dark"><?php the_field('degree_type'); ?> in <?php the_title(); ?></span> --></h1></a>
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
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-title-wrap">
				<div class="row">
					<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
						<a class="no-line" href="<?php the_permalink(); ?>"><h2 class="inner-title dark"><span class="red">Program:</span> <?php 
						
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
						?></h2></a>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<ul id="share-icons">
							<li><a class="no-line" href="javascript:window.print()" alt="print" title="Print this page.">
								<span class="glyphicon glyphicon-print share-icon"></span>
							</a></li>
							<li><?php pdf_all_button(); ?></li>
							<li>
								<span class='st_sharethis' st_title='Share this page with others' st_url='<?php the_csun_permalink(); ?>'>
									<span id="csun-sharethis" style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;" class="stButton">
										<span class="stLarge glyphicon glyphicon-share share-icon"></span>
										<img src="http://w.sharethis.com/images/check-big.png" style="position: absolute; top: -7px; right: -7px; width: 19px; height: 19px; max-width: 19px; max-height: 19px; display: none;">
									</span>
								</span>
							</li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div id="breadcrumbs-wrap" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<span><?php echo the_breadcrumb(); ?></span>
					</div>
				</div>
			</div>
			<div class="pad-box">
				<div id="inset-content">

				<?php if(have_posts()): while (have_posts()) : the_post(); ?>
				
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
							<div class="section-content">
								<span class="section-title"><span><h2>Overview</h2></span></span> 
								<?php the_content(); ?>
							</div>
							<div class="section-content">
								<span class="section-title"><span><h2>Program Requirements</h2></span></span> 
								<p><?php the_field('program_requirements'); ?></p>
							</div>	
							<div class="section-content">
								<span class="section-title"><span><h2>More information</h2></span></span> 
								<p>If you would like more information about this program please contact
									<a href="mailto:<?php the_field('email_contact'); ?>" title="Email questions about the program"><?php the_field('email_contact'); ?></a>.
								</p>
							</div>	
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
							<div class="section-content col-sm-6 col-md-12 col-lg-12">
								<span class="section-title"><span><h2>Contact</h2></span></span> 
								<p><?php echo get_csun_contact($dept); ?></p>
							</div>

							<?php $values = get_field('slos');
							if ( $values != false ) : ?>
								<div class="section-content col-sm-6 col-md-12 col-lg-12 ">
									<span class="section-title"><span><h2>Student Learning Outcomes</h2></span></span> 
									<p><?php the_field('slos'); ?></p>
								</div>
							<?php endif; ?>


							<?php $values = get_field('degree_plan');
							if ( $values != false) : ?>
								<div class="section-content col-sm-6 col-md-12 col-lg-12">
									<span class="section-title"><span><h2>4 Year Plans</h2></span></span> 
									<p><?php the_field('degree_plan'); ?></p>
								</div>	
							<?php endif; ?>

							<?php $values = get_field('star_act');
							if ( $values != false ) : ?>
								<div class="section-content col-sm-6 col-md-12 col-lg-12">
									<span class="section-title"><span><h2>STAR Act</h2></span></span> 
									<p><?php the_field('star_act'); ?></p>
								</div>
							<?php endif; ?>

						</div>
					</div>
					
				<?php endwhile; endif; ?>
					
				</div>
			</div> <!-- end pad-box -->
		</div>
	</div>
</div>

<?php get_footer(); ?>
