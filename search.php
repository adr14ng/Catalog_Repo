<?php 

/**
 * Template Name: Search Results Template
 */ 

$page_num = get_query_var('paged');
	
if(isset($_REQUEST['advanced_search']))
{
	list($search_query, $advanced_query) = process_advanced_edit($_REQUEST);
	if(!empty($page_num))
	{
		$advanced_query->current_post = ($page_num* 10) - 11;
	}
	$num = 0;
}
else
{
	list($filter_types, $checked) = process_simple_edit($_REQUEST);
	$simple_search = true;
	$search_query = get_search_query();
}
 
get_header(); ?>

<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<a class="dept-title-small" href="<?php echo site_url('/advanced-search/'); ?>">Search</a>
					<h1 class="prog-title">&quot;<?php echo $search_query; ?>&quot;</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="row">
			<div class="section-content">
				<?php if($simple_search) : ?>
				<div class="col-xs-12 col-md-3">
					<span class="section-title"><span><h2>Filter</h2></span></span>
					<form class="clearfix" id="type-filter" role="search" method="get" action="<?php echo home_url( '/'); ?>">
						<ul class="checkbox-list">
						<?php foreach($filter_types as $id=>$text) : ?>
							<li>
								<input type="checkbox" name="post_type[]" value="<?php echo $id; ?>" id="<?php echo $id; ?>" <?php if($checked[$id]) echo 'checked'; ?>/>
								<label for="<?php echo $id; ?>"><?php echo $text; ?></label>
							</li>
						<?php endforeach; ?>
						</ul>
						<input type="hidden" name="s" value="<?php echo $search_query; ?>" />
						<input class="btn btn-primary pull-right" type="submit" value="Filter">
					</form>
					
					<p><a href="<?php echo site_url('/advanced-search/'); ?>">Advanced Search</a></p>
				</div>
				<?php endif; ?>
				<div class="col-xs-12 col-md-9">
				<?php if (function_exists('relevanssi_didyoumean') && !is_class_search($search_query)) { 
					relevanssi_didyoumean(get_search_query(), "<p>Did you mean: ", "</p>", 5);
				}?>
				<?php if($simple_search) : ?>
					<?php if(have_posts()): while (have_posts()) : the_post(); ?>

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">
							<a href="<?php the_permalink(); ?>" class="csun-subhead"><h2 class="csun-subhead"><?php the_title(); ?></h2></a>
							<p><?php the_excerpt(); ?></p>
						</div>
						
					<?php endwhile; else: ?>

						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
						

					<?php endif; ?>
				<?php else: ?>
					<?php if($advanced_query->have_posts()): while ($advanced_query->have_posts() && $num < 10) : $advanced_query->the_post(); $num++; ?>

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">
							<a href="<?php the_permalink(); ?>" class="csun-subhead"><h2 class="csun-subhead"><?php the_title(); ?></h2></a>
							<p><?php the_excerpt(); ?></p>
						</div>
						
					<?php endwhile; else: ?>

						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
						

					<?php endif; ?>
				<?php endif; ?>
				</div>
			</div>
			<div class="pagination-content">
				<div class="col-xs-12 col-md-9">
				<?php
					if($simple_search) :
						global $wp_query;
						$max_pages = $wp_query->max_num_pages;
					else :
						$max_pages = ceil($advanced_query->post_count/10);
					endif;

					$big = 999999999; // need an unlikely integer

					$pages = paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, $page_num ),
						'total' => $max_pages,
						'prev_text' => '&laquo;',
						'next_text' => '&raquo;',
						'type' => 'array',
					) );?>
					
					<ul class="pagination">
					<?php if(!empty($pages)) : foreach($pages as $page) : ?>
						
						<li><?php echo $page; ?></li>
					
					<?php endforeach; endif; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); 

function process_simple_edit($params)
{
	global $hns_search_result_type_counts;

	$filter_types = array();
	$checked = array();
	$search_query = get_search_query();
	$taxes = get_taxonomies();

	if(isset($_REQUEST['post_type']))	
	{
		$no_filter_query = new WP_Query(
			array(
				's'=>$search_query, 
				'posts_per_page'=>200, 
			)
		);
		relevanssi_do_query($no_filter_query);
		
		if(isset($_REQUEST['post_type'])) : foreach($_REQUEST['post_type'] as $type) :
			$checked[$type] = true;
		endforeach; endif;
	}

	$post_counts = $hns_search_result_type_counts;

	foreach($post_counts as $type=>$count)
	{
		if($count > 0 && !in_array($type, $taxes))
		{
			$filter_types[$type] = get_post_type_object($type)->label;
		}
	}
	
	return array($filter_types, $checked);
}

function process_advanced_edit($params)
{
	$andwords = explode(' ', $params['and-words']);
	$notwords = explode(' ', $params['not-words']);
	$search_query = $params['or-words'];
	if(!empty($params['exact-words']))
	{
		$search_query .=' "'.$params['exact-words'].'"';
	}
	foreach($andwords as $word)
	{
		if($word !== '')
			$search_query.= " +".$word;
	}
	foreach($notwords as $word)
	{
		if($word !== '')
			$search_query.= " -".$word;
	}
	
	$args = parse_advanced_search($params);
	$args['s'] = $search_query;
	
	$advanced_query = new WP_Query( $args );
	relevanssi_do_query($advanced_query);
	
	$search_query .= " ".advanced_search_description($params);
	$search_query = trim($search_query);
	
	return array($search_query, $advanced_query);
}