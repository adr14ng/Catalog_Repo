<?php 

/**
 * Template Name: Programs Single View
 */



$dept = get_query_var( 'department_shortname' );
$deptterm = get_term_by( 'slug', $dept, 'department_shortname' );
$deptdesc = $deptterm->description;

$funding = get_field('fund_source');



if($funding === 'self')
	$self = true;
elseif($funding === 'both')
	$both = true;
	
$post_option=get_field('option_title');

if(isset($post_option)&&$post_option!=='')
	$option = true;
 
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
						<a class="no-line" href="<?php the_permalink(); ?>">
							<h2 class="inner-title dark <?php if($option) echo 'with-option'; ?>">
							<span class="red">Program:</span> <?php 
						
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
							
							
						?></h2>
						<?php 
							$post_option=get_field('option_title');

							if(isset($post_option)&&$post_option!=='') {
								echo '<h3 class="sm-h4 option-title">'.$post_option.'</h3>';
							}
						?>
						</a>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<?php 
							$subject_line = "CSUN Catalog - ".$title;
							$subject_line = str_replace(' ', '%20', $subject_line);
							$body = 'Permalink : '.get_csun_permalink();
							$body = str_replace(' ', '%20', $body);
						?>
						<ul id="share-icons">
							<!-- <li><?php pdf_all_button(); ?></li> -->
							<li>
								<a class="no-line" title="Email this page" 
									href='mailto:?subject=<?php echo $subject_line ?>&amp;body=<?php echo $body; ?>' >
									<span class="stLarge glyphicon glyphicon glyphicon-envelope share-icon"></span>
									<span class="screen-reader-text">email</span>
								</a>
							</li>
							<li><a class="no-line" href="javascript:window.print()" title="Print this page.">
								<span class="glyphicon glyphicon-print share-icon"></span>
								<span class="screen-reader-text">print</span>
							</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div id="breadcrumbs-wrap" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<?php echo the_breadcrumb(); ?>
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
							<?php if($self): ?>
								<div class="section-content well well-tseng">
									This program is administered through the <a href="http://tsengcollege.csun.edu/" title="Tseng College Webpage">The Tseng College</a>.
									It is entirely funded by student fees, offered in the cohort format and features evening and weekend course schedules.
								</div>
							<?php endif; ?>
							<?php if($both): ?>
								<div class="section-content well well-tseng">
									This program can be entered through one of the CSUN academic colleges or through the <a href="http://tsengcollege.csun.edu/" title="Tseng College Webpage">The Tseng College</a>. 
									The program offered through the Tseng College is entirely funded by student fees, offered in the cohort format and features evening and weekend course schedules.
								</div>
							<?php endif; ?>
							<?php $values = get_field('program_requirements');
							if ( $values != false ) : ?>
								<div class="section-content">
									<span class="section-title"><span><h2>Program Requirements</h2></span></span> 
									<?php the_field('program_requirements'); ?>
								</div>
							<?php endif; ?>
							<?php $values = get_field('email_contact');
							if ( $values != false ) : ?>							
								<div class="section-content">
									<span class="section-title"><span><h2>More information</h2></span></span> 
									<p>If you would like more information about this program, please contact
										<a href="mailto:<?php the_field('email_contact'); ?>" title="Email questions about the program"><?php the_field('email_contact'); ?></a>.
									</p>
								</div>	
							<?php endif; ?>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
							<div class="section-content col-sm-6 col-md-12 col-lg-12">
								<span class="section-title"><span><h2>Contact</h2></span></span> 
								<?php echo get_csun_contact($dept); ?>
							</div>

							<?php $values = get_field('slos');
							if ( $values != false ) : ?>
								<div class="section-content col-sm-6 col-md-12 col-lg-12 ">
									<span class="section-title"><span><h2>Student Learning Outcomes</h2></span></span> 
									<?php the_field('slos'); ?>
								</div>
							<?php endif; ?>


							<?php $values = get_field('degree_plan');
							if ( $values != false) : ?>
								<div class="section-content col-sm-6 col-md-12 col-lg-12">
									<span class="section-title"><span><h2>4-Year Plans</h2></span></span> 
									<?php the_field('degree_plan'); ?>
								</div>	
							<?php endif; ?>

							<?php $values = get_field('star_act');
							if ( $values != false ) : ?>
								<div class="section-content col-sm-6 col-md-12 col-lg-12">
									<span class="section-title">
										<span><h2>STAR Act</h2></span>
										<div class= "more-info pull-right" id="star-info" data-toggle="popover" data-placement="bottom" title="What is the STAR Act" 
											data-content="Students who have graduated with a verified Associate Degree for Transfer and been admitted to a CSUN program that has been deemed similar, will be able to complete the Baccalaureate Degree within 60 semester units.">
											<span class="glyphicon glyphicon glyphicon-info-sign"></span>
										</div>
									</span> 
									<?php the_field('star_act'); ?>
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