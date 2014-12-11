<?php 
/**
 * Template Name: Planning by Department Template
 */ 

$type = get_query_var( 'post_type' );
$dept = get_query_var( 'department_shortname' );

if(!isset($type) || $type == ''){
	$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	
	if ( false !== strpos($url, 'staract') ) {
		$type = 'staract';
		$url = 'star-act/';
		$title = 'STAR Act';
	} 
	else {
		$type = 'plans';
		$url = '';
		$title = 'Degree Planning Guides';
	}

}

get_header(); ?>



<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<a class="dept-title-small" href="<?php echo site_url('/plan/'.$url); ?>"><?php echo ucwords($title); ?></a>
					<h1 class="prog-title"><?php echo $dept; ?></h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="row small-marg-top small-marg-bottom">
			<div class="col-xs-12">

				<?php 
				$terms = get_terms('aca_year', array('orderby' => 'name', 'order' => 'DESC',));
				foreach($terms as $term) : 
					
					$query_plans = new WP_Query(array(
						'post_type' => $type, 
						'orderby' => 'title', 
						'order' => 'ASC',  
						'department_shortname' => $dept, 
						'aca_year' => $term->slug, 
						'posts_per_page' => 1000,));
						
					if($query_plans->have_posts()) :
						
						echo '<span class="section-title"><span><h2>'.$term->slug.'</h2></span></span>';
						
						while($query_plans->have_posts()) : $query_plans->the_post(); ?>
								
						<p><a href="<?php the_permalink();?>"><?php the_title(); ?></a></p>

					<?php endwhile; ?>
				<?php endif; endif; endforeach;?>
				<?php wp_reset_query(); ?>
			</div>
		</div>
	</div>
</div>



<?php get_footer(); ?>