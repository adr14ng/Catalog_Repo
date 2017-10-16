<?php /**

 * Template Name: Staract Years List

 */
$options = get_option( 'main_dp_settings' );	//get our options
$planning_year = $options['planning_year'];
get_header(); ?>



<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<a class="dept-title-small" href="<?php echo site_url('/resources'); ?>">Resources</a>
					<h1 class="prog-title">ADT/STAR Act Degree Road Maps</h1>
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
					<div class="span10">
					<?php if (have_posts()) : while (have_posts()) : the_post();?>

						<?php the_content(); ?>

					<?php endwhile; endif; ?>

						<?php
						$years = get_terms( 'aca_year', array('orderby' => 'name', 'order' => 'DESC',) );
						$url = site_url('/resource/star-act/');?>

						<div class="plan-grid clearfix"><ul>

						<?php foreach($years as $year) :
							if($year->slug <= $planning_year) :
							$query_plans = new WP_Query(array(
							'post_type' => 'staract',
							'aca_year' => $year->slug,
							'posts_per_page' => 1000,));


							if($query_plans->have_posts()) :?>

								<li><a href="<?php echo $url.$year->slug; ?>"><?php echo $year->slug; ?></a></li>

							<?php endif;endif;?>
						<?php endforeach; ?>
						</ul></div>
						<div>
							<h4 class="pseudo-h5">Or by Department, Program or College: </h4>
							<?php
							$depts = sort_terms_by_description(get_terms( 'department_shortname'));
							$url = site_url('/resource/star-act/');?>

							<div class="dept-container content">

							<?php foreach($depts as $dept) :
								$query_plans = new WP_Query(array(
								'post_type' => 'staract',
								'department_shortname' => $dept->slug,
								'posts_per_page' => 1000,));

								if($query_plans->have_posts()) :?>

									<a class="dept-item " href="<?php echo $url.$dept->slug; ?>"><?php echo $dept->description; ?></a>

								<?php endif;?>
							<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php get_footer(); ?>
