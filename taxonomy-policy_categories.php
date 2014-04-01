<?php

/** Template Name: Policy Categories View
 * The template to display policy categories
 */

$keyword = get_query_var( 'policy_categories' );
$keyword_term = get_term_by( 'slug', $keyword, 'policy_categories' );
$keyword_title = ucwords($keyword_term->name);


get_header(); ?>
<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<a class="dept-title-small" href="<?php echo site_url('/policies/appendix/'); ?>">Policies</a>
					<h1 class="prog-title"><?php echo $keyword_title; ?></h1>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="row">
			<div class="section-content">
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 left-sidebar ">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix noborder">
						<span class="section-title"><span><h2>All Policies</h2></span></span>
						<a href="<?php echo site_url('/policies/alphabetical/'); ?>">Alphabetical</a></br>
						<a href="<?php echo site_url('/policies/appendix/'); ?>">Appendix</a>
					</div>
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
				
				<?php if(have_posts()): while (have_posts()) : the_post(); ?>
				
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">
						<a href="<?php the_permalink(); ?>"><h3 class="csun-subhead"><?php the_title(); ?></h3></a>
						<p><?php the_excerpt(); ?></p>
						<a class="read-more" href="<?php the_permalink(); ?>">[ View Policy ]</a>
					</div>

				<?php endwhile; else: ?>

					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

				<?php endif; ?>
				
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>