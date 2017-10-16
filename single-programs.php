<?php

/**
 * Template Name: Programs Single View
 */



$dept = get_query_var( 'department_shortname' );
$deptterm = get_term_by( 'slug', $dept, 'department_shortname' );
$deptdesc = $deptterm->description;

$funding = get_field('fund_source');
$disclosure_notif = get_field('disclosure_for_liscensure_credential_programs');
$custom_contact = get_field('custom_contact');


if($funding === 'self')
	$self = true;
elseif($funding === 'both')
	$both = true;

if($disclosure_notif === 'displayed')
	$displayed = true;
elseif($disclosure_notif === 'notDisplayed')
	$notDisplayed = true;

$post_option=get_field('option_title');

if(isset($post_option)&&$post_option!=='')
	$option = true;

$option = get_option( 'main_dp_settings' );	//get our options
$planning_year = $option['planning_year'];
$tseng_only = $option['tseng_description'];
$tseng_both = $option['tseng_both'];
$display_disclosure = $option['disclosure'];
$display_star_msg = $option['star_plan_msg'];

get_header(); ?>


<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<a class="dept-title-small" href="<?php echo get_csun_archive('programs', $dept); ?>">Programs</a>
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
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-title-wrap">
				<div class="row">
					<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
						<h2 class="inner-title dark <?php if($option) echo 'with-option'; ?>">
						<span class="red">Program:</span> <?php

						$degree = get_field('degree_type');
						$title = get_the_title();

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
						else{
							$title = $degree.', '.$title;
						}

						echo $title;

						?></h2>
						<?php
							$post_option=get_field('option_title');

							if(isset($post_option)&&$post_option!=='') {
								echo '<h3 class="pseudo-h5 option-title">'.$post_option.'</h3>';
							}
						?>
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
								<span class="section-title"><span><h2>Program Description</h2></span></span>
								<?php the_content(); ?>
							</div>
							<?php if($self): ?>
								<div class="section-content well well-tseng">
									<?php echo $tseng_only; ?>
								</div>
							<?php endif; ?>
							<?php if($both): ?>
								<div class="section-content well well-tseng">
									<?php echo $tseng_both; ?>
								</div>
							<?php endif; ?>
							<?php if($displayed): ?>
								<div class="section-content well well-tseng" style="background-color:steelblue;">
									<?php echo $display_disclosure; ?>
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
								<?php if($custom_contact):
									the_field('program_contact');
								else:
									echo get_csun_contact($dept);
								endif; ?>
							</div>

							<?php $values = get_field('slos');
							if ( $values != false ) : ?>
								<div class="section-content col-sm-6 col-md-12 col-lg-12 ">
									<span class="section-title"><span><h2>Student Learning Outcomes</h2></span></span>
									<?php the_field('slos'); ?>
								</div>
							<?php endif; ?>


							<?php $args = array(
								'posts_per_page'	=> 40,
								'post_type' 		=> 'plans',
								'meta_query' 		=> array(
									array(
										'key' 		=> 'degree_planning_guides',
										'value' 	=> '"'. get_the_ID() . '"',
										'compare' 	=> 'LIKE'
									)
								),
								'aca_year' 			=> $planning_year,
								'order'				=> 'ASC',
								'orderby'			=> 'title',
							);

							$plans = get_posts($args);

							if ( $plans ) : ?>
								<div class="section-content col-sm-6 col-md-12 col-lg-12">
									<span class="section-title"><span><h2>Degree Road Maps</h2></span></span>
									<?php foreach($plans as $plan): ?>
										<p><a title="Degree Road Map for <?php echo $plan->post_title.' - '.$planning_year; ?>" href="<?php echo get_permalink($plan->ID); ?>"><?php echo $plan->post_title.' - '.$planning_year; ?></a></p>
									<?php endforeach; ?>
									<p><a title="Previous Years' Degree Road Maps" href="<?php echo site_url('/resource/road-map/'.$dept); ?>">Previous Years</a></p>
								</div>
							<?php endif; ?>

							<?php $args['post_type'] = 'transfer_plans';

							$plans = get_posts($args);

							if ( $plans ) : ?>
							<div class="section-content col-sm-6 col-md-12 col-lg-12">
								<span class="section-title"><span><h2>Transfer Road Maps</h2></span></span>
								<?php foreach($plans as $plan): ?>
									<p><a title="Transfer Road Map for <?php echo $plan->post_title.' - '.$planning_year; ?>" href="<?php echo get_permalink($plan->ID); ?>"><?php echo $plan->post_title.' - '.$planning_year; ?></a></p>
								<?php endforeach; ?>
								<p><a title="Previous Years' Transfer Road Maps" href="<?php echo site_url('/resource/transfer-road-map/'.$dept); ?>">Previous Years</a></p>
							</div>
						<?php endif; ?>


							<?php $args['post_type'] = 'staract';

							$plans = get_posts($args);

							if ( $plans ) : ?>
								<div class="section-content col-sm-6 col-md-12 col-lg-12">
									<span class="section-title" >
										<span><h2>ADT/STAR Act Degree Road Maps</h2></span>
									</span>
									<p id="define-star-act-define-p">
										<?php echo $display_star_msg; ?>
									</p>
										<!--
										<div id="define-star-act-div">
											<div id="define-star-act-div-p">
												<p id="define-star-act-define-p">
													Students who have graduated with a verified Associate Degree for Transfer and have been admitted to a CSUN program that has been deemed similar will be able to complete the baccalaureate degree within 60 semester units. For additional information, see
													<a href="http://catalogtest.wpengine.com/resources/star-act/">ADT/STAR Act Degree Road Maps</a>.
												</p>
											</div>
										</div>
									-->

									<?php foreach($plans as $plan): ?>
									<p><a title="STAR Act for <?php echo $plan->post_title.' - '.$planning_year; ?>" href="<?php echo get_permalink($plan->ID); ?>"><?php echo $plan->post_title.' - '.$planning_year; ?></a></p>
									<?php endforeach; ?>
									<p><a title="Previous Years' STAR-Act Road Maps" href="<?php echo site_url('/resource/star-act/'.$dept); ?>">Previous Years</a></p>
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
