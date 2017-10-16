<?php

/**
 * Template Name: Staract Single View
 */

$id = get_the_ID();
$years = get_the_terms( $id, 'aca_year');

foreach($years as $year)
	$aca_year = $year->name;

$intstartyear = intval($aca_year);

$intendyear = $intstartyear + 1;
$aca_end_year = strval($intendyear);

$archive_checkbox = get_field('archive_url_check_box');

$plan_names = get_field('plan_name');	//get plan name from wordpress
$plan_option_names = get_field('plan_option_name');	//get plan option from wordpress
$archive_urls = get_field('archive_url');	//get plan url from wordpress


$options = get_option( 'main_dp_settings' );	//get our options
$planning_year = $options['planning_year'];
$old_planning_year = $options['old_planning_year'];

$programs = get_field('degree_planning_guides');

if($programs) {

	$programs = $programs[0];
	//get department
	//$depts = get_the_terms($programs->ID, 'department_shortname');
	$depts = get_the_terms($id, 'department_shortname');
	}
else {
	$depts = get_the_terms($id, 'department_shortname');
}
if($depts)
{
	$depts = $depts[0];
	$department = '<a href="'.site_url().'/resource/star-act/'.$depts->slug.'">'.$depts->description.'</a>';

	$col = get_term_by('id', $depts->parent, 'department_shortname');
	if($col)
	{
		$college = '<a href="'.site_url().'/resource/star-act/'.$col->slug.'">'.$col->description.'</a>';
	}
}


get_header(); ?>



<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<a class="dept-title-small" href="<?php echo site_url('/resources/star-act/'); ?>">ADT/STAR Act Degree Road Maps</a>
					<h1 class="prog-title"><?php echo $aca_year.' '; the_title(); ?></h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="main-section" class = "main plans">
	<div class="container" id="wrap">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="row">
				<div id="breadcrumbs-wrap" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<ul id="breadcrumbs">
						<li><a href="<?php echo site_url('/resources/star-act/'); ?>">ADT/STAR Act Degree Road Maps</a></li>
						<li class="separator"> / </li>

						<li><?php echo $college; ?></li>
						<li class="separator"> / </li>

						<li><?php echo $department; ?></li>

					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="pad-box">
				<div id="inset-content">
				<?php if(have_posts()): while (have_posts()) : the_post(); ?>

					<div class="row">
						<div class="col-xs-12">
							<div class="section-content">
								<?php if($archive_checkbox): ?>
								<a class="planning-degree-title" title="<?php echo $aca_year; ?>-<?php echo $intendyear; ?> Catalog Archive Page" href="<?php echo $archive_urls; ?>"
									target="_blank">
									<h2><?php echo $plan_names; ?><br>
									<span class="option-title"><?php echo $plan_option_names; ?></span>
									</h2>
								</a>
								<?php endif; ?>
								<?php
								if($planning_year == $aca_year) :
									if($programs) :
										$name = program_name($programs->ID);
									?>
									<a class="planning-degree-title" href="<?php echo get_permalink($programs->ID); ?>">
										<h2><?php echo $name; ?>

											<?php $post_option=get_field('option_title', $programs->ID);
											if(isset($post_option)&&$post_option!=='') : ?>
												<span class="option-title"><?php echo $post_option; ?> Option</span>
											<?php endif; ?>
										</h2>
									</a>
								<?php endif; endif; ?>
								<?php if($aca_year <= $old_planning_year) : ?>
									<p><?php echo $options['old_plan_message']; ?></p>
								<?php endif; ?>
								<?php the_content(); ?>
							</div>
						</div>
					</div>

				<?php endwhile; else: ?>

					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

				<?php endif; ?>
				</div>
			</div> <!-- end pad-box -->
		</div> <!-- end inset-content -->
	</div>
</div>

<?php get_footer(); ?>
