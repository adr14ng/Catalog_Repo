<?php
/**
 * Template Name: Faculty Directory Archive Template
 *
 * There are three different pages within this template
 * The Department style page, the all emeriti page,
 * and the all current page
 */

$dept = get_query_var( 'department_shortname' );
if($dept === 'emeriti') {
	$title = 'Emeriti';
	$url = site_url('/emeriti/');
	$emer = true;
}
else {
	$title = 'Faculty and Administration';
	$url = site_url('/faculty/');
}

$letter = strtoupper(get_query_var( 'directory', 'a' ));

if(!$emer)
{
	$args = array( 'directory' => get_query_var( 'directory', 'a' ), 'order' => 'ASC', 'orderby' => 'title' );
	query_posts($args);
}

get_header(); ?>

	<div class="row" id="subnav-wrap">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="section-content page-title-section">
						<span class="dept-title-small">Faculty and Administrators</span>
						<h1 class="prog-title"><?php echo $title; ?></h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="main-section"  class = "main">
		<div class="container" id="wrap">
			<div class="row">
				<div class="section-content">
					<div class="col-xs-12">
						<div id="direc_nav" class="well well-sm">
							<nav class="center">
							<?php foreach (range('A', 'Z') as $char) : ?>
								<span class="space_char">
									<a href="<?php echo $url.strtolower($char); ?>"><?php echo $char; ?></a>
								</span>
							<?php endforeach; ?>
							</nav>
						</div>
<?php
					echo '<span class="section-title abc_title"><span><h2 id="index-'.$letter.'">'.$letter.'</h2></span></span>';

					if(have_posts()): while (have_posts()) : the_post(); ?>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">
							<a class="csun-subhead" href="<?php the_permalink(); ?>"><h3 class="csun-subhead"><?php the_title(); ?></h3></a>
							<?php the_excerpt(); ?>
						</div>
<?php
					endwhile; else:
						if($emer) :
							echo '<p>Sorry, no emeritus faculty found in this section.</p>';
						else:
							echo '<p>Sorry, no faculty found in this section.</p>';
						endif;
					endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>
