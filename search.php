<?php 

/**
 * Template Name: Search Results Template
 */ 

 
if(isset($_REQUEST['advanced_search']))
{
	list($search_query, $advanced_query) = process_advanced_edit($_REQUEST);
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
					<form id="type-filter" role="search" method="get" action="<?php echo home_url( '/'); ?>">
						<ul class="checkbox-list">
						<?php foreach($filter_types as $id=>$text) : ?>
							<li>
								<input type="checkbox" name="post_type[]" value="<?php echo $id; ?>" id="<?php echo $id; ?>" <?php if($checked[$id]) echo 'checked'; ?>/>
								<label for="<?php echo $id; ?>"><?php echo $text; ?></label>
							</li>
						<?php endforeach; ?>
						</ul>
						<input type="hidden" name="s" value="<?php echo $search_query; ?>" />
						<input type="submit" value="Submit">
					</form>
				</div>
				<?php endif; ?>
				<div class="col-xs-12 col-md-9">
				<?php if (function_exists('relevanssi_didyoumean')) { 
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
					<?php if($advanced_query->have_posts()): while ($advanced_query->have_posts()) : $advanced_query->the_post(); ?>

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
	
	$tax_query = array();
	$meta_query = array();
	
	//college
	if(!empty($params['college']))
	{
		$tax_query['dpt'] = array(
			'taxonomy' 	=> 'department_shortname',
			'field'		=> 'slug',
			'terms'		=> $params['college'],
		);
	}
	//department
	if(!empty($params['department']))
	{
		if(isset($tax_query['dpt']))
		{
			if(is_array($tax_query['dpt']['terms']))
			{
				$tax_query['dpt']['terms'][] = $params['department'];
			}
			else
			{
				$tax_query['dpt']['terms'] = array($tax_query['dpt']['terms'], $params['department']);
			}
		}
		else
		{
			$tax_query['dpt'] = array(
				'taxonomy' 	=> 'department_shortname',
				'field'		=> 'slug',
				'terms'		=> $params['department'],
			);
		}
	}
	//department_code
	if(!empty($params['department_code']))
	{
		if(isset($tax_query['dpt']))
		{
			if(is_array($tax_query['dpt']['terms']))
			{
				$tax_query['dpt']['terms'][] = $params['department_code'];
			}
			else
			{
				$tax_query['dpt']['terms'] = array($tax_query['dpt']['terms'], $params['department_code']);
			}
		}
		else
		{
			$tax_query['dpt'] = array(
				'taxonomy' 	=> 'department_shortname',
				'field'		=> 'slug',
				'terms'		=> $params['department_code'],
			);
		}
	}
	//degree_level
	if(!empty($params['degree_level']))
	{
		$tax_query[] = array(
			'taxonomy' 	=> 'degree_level',
			'field'		=> 'slug',
			'terms'		=> $params['degree_level'],
		);
	}
	//fund_source
	if(!empty($params['fund_source']))
	{
		$meta_query[] = array(
			'meta_key'		=> 'fund_source',
			'meta_value'	=> $params['fund_source'],
			'compare' 		=> '=',
		);
	}
	//aca_year
	if(!empty($params['aca_year']))
	{
		$tax_query[] = array(
			'taxonomy' 	=> 'aca_year',
			'field'		=> 'slug',
			'terms'		=> $params['aca_year'],
		);
	}
	//hire_year
	if(!empty($params['hire_year']))
	{
		if($params['hire_year'] < 40)
		{
			$params['hire_year'] += 2000;
		}
		elseif($params['hire_year'] < 100)
		{
			$params['hire_year'] += 1900;
		}
		
		$meta_query[] = array(
			'key'		=> 'hire_year',
			'value'		=> array($params['hire_year_start'], $params['hire_year_end']),
			'type'		=> 'numeric',
			'compare' 	=> 'BETWEEN',
		);
		
	}
	//current
	if(!empty($params['current']))
	{
		if(empty($params['administrator']) && empty($params['emeritus']))
		{
			$tax_query[] = array(
				'taxonomy' => 'department_shortname',
				'terms' => array ( 'emeriti',  'admin') ,
				'include_children' => 1 ,
				'field' => 'slug' ,
				'operator' => 'NOT IN',
			);
		}
	}
	//administrator
	if(!empty($params['administrator']))
	{
		if(empty($params['current']))
		{
			if(isset($tax_query['dpt']))
			{
				if(is_array($tax_query['dpt']['terms']))
				{
					$tax_query['dpt']['terms'][] = 'admin';
				}
				else
				{
					$tax_query['dpt']['terms'] = array($tax_query['dpt']['terms'], 'admin');
				}
			}
			else
			{
				$tax_query['dpt'] = array(
					'taxonomy' 	=> 'department_shortname',
					'field'		=> 'slug',
					'terms'		=> 'admin',
				);
			}
		}
	}
	//emeritus
	if(!empty($params['emeritus']))
	{
		if(empty($params['current']))
		{
			if(isset($tax_query['dpt']))
			{
				if(is_array($tax_query['dpt']['terms']))
				{
					$tax_query['dpt']['terms'][] = 'emeriti';
				}
				else
				{
					$tax_query['dpt']['terms'] = array($tax_query['dpt']['terms'], 'emeriti');
				}
			}
			else
			{
				$tax_query['dpt'] = array(
					'taxonomy' 	=> 'department_shortname',
					'field'		=> 'slug',
					'terms'		=> 'emeriti',
				);
			}
		}
	}
	//general_education_department
	if(!empty($params['general_education_department']))
	{
		if(isset($tax_query['dpt']))
		{
			if(is_array($tax_query['dpt']['terms']))
			{
				$tax_query['dpt']['terms'][] = 'ge';
			}
			else
			{
				$tax_query['dpt']['terms'] = array($tax_query['dpt']['terms'], 'ge');
			}
		}
		else
		{
			$tax_query['dpt'] = array(
				'taxonomy' 	=> 'department_shortname',
				'field'		=> 'slug',
				'terms'		=> 'ge',
			);
		}
	}
	//general_education
	if(!empty($params['general_education']))
	{
		$tax_query[] = array(
			'taxonomy' 	=> 'general_education',
			'field'		=> 'slug',
			'terms'		=> $params['general_education'],
		);
	}
	
	if(count($tax_query) > 1)
	{
		$tax_query['relation'] = 'AND';
	}
	
	if(count($meta_query) > 1)
	{
		$meta_query['relation'] = 'AND';
	}
	
	$args = array(
		'post_type' 	=> $params['post_type'],
		's'				=> $search_query,
		'meta_query'	=> $meta_query,
		'tax_query'		=> $tax_query,
	);
	
	$advanced_query = new WP_Query( $args );
	relevanssi_do_query($advanced_query);
	
	
	return array($search_query, $advanced_query);
}