<?php 

/**
 * Template Name: Default Search Template
 */ 


get_header(); ?>
<?php
global $query_string;

$query_args = explode("&", $query_string);
$search_query = array();

foreach($query_args as $key => $string) {
	$query_split = explode("=", $string);
	$search_query[$query_split[0]] = urldecode($query_split[1]);
} // foreach

$search = new WP_Query($search_query);
?>
<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<a class="dept-title-small" href="">Search</a>
					<a href="<?php echo site_url("/?s=".$_GET['s']); ?>"><h1 class="prog-title">&quot;<?php echo get_search_query(); ?>&quot;</h1></a>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="row">
			<div class="section-content">
				<div class="col-xs-12 col-md-9">

				<?php if(have_posts()): while (have_posts()) : the_post(); ?>

					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">
						<a href="<?php the_permalink(); ?>"><h2 class="csun-subhead"><?php the_title(); ?></h2></a>
						<p><?php the_excerpt(); ?></p>
						<a class="read-more" href="<?php the_permalink(); ?>">[ View Result ]</a>
					</div>
					
				<?php endwhile; else: ?>

					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

				<?php endif; ?>
				</div>
			</div>
			<div class="pagination-content">
				<div class="col-xs-12 col-md-9">
				<?php
					global $wp_query;

					$big = 999999999; // need an unlikely integer

					$pages = paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $wp_query->max_num_pages,
						'prev_text' => '&laquo;',
						'next_text' => '&raquo;',
						'type' => 'array',
					) );?>
					
					<ul class="pagination">
					<?php foreach($pages as $page) : ?>
						
						<li><?php echo $page; ?></li>
					
					<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>