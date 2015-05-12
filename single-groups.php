<?php 
/**
 * Template Name: Group Single View
 */ 
 
$terms = get_the_terms($post->ID, 'group_type');

foreach($terms as $term)
{
	$title = $term->name;
	break;
}

$page = get_posts( array(
	'group_type' => $term->slug,
	'post_type' => 'page',
	)
);



$link = get_permalink($page[0]->ID);
 
get_header(); ?>



<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<?php if(!empty($page[0]->ID)) : ?>
					<a class="dept-title-small" href="<?php echo $link; ?>"><?php echo $title; ?></a>
					<?php else : ?>
					<span class="dept-title-small"><?php echo $title; ?></span>
					<?php endif; ?>
					<h1 class="prog-title"><?php the_title(); ?></h1>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="section-content">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; endif; ?>
						</div>
					</div>
				</div>
			</div><!--/end col -->
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="section-content contact">
					<span class="section-title"><span><h2>Contact</h2></span></span> 
					<?php the_field('contact'); ?>
				</div>
			</div> <!--/end col -->
		</div><!--/end row -->
	</div><!--/end wrap -->
</div><!--/end main-section -->


<?php get_footer(); ?>