<?php

/*Template Name: Degree Level Template
 */ 

get_header(); 

$level = get_query_var( 'degree_level' );

if($level === 'minor')
	$level = 'Minors';
elseif($level === 'major')
	$level = 'Majors and Options';
else
	$level = ucwords($level);

//Make ascending by title
global $query_string;
query_posts( $query_string . '&orderby=title&order=ASC' );

$num = $wp_query->post_count;
?>

<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<span class="dept-title-small" >Programs</span>
					<h1 class="prog-title"><?php echo $level.' ('.$num.')'; ?></h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="dept-container content">
		<?php if(have_posts()): while (have_posts()) : the_post(); ?>
				<a class="dept-item " href="<?php the_permalink(); ?>"><?php 
					$degree = get_field('degree_type'); 
					$title = get_the_title(); 
						
					$post_option=get_field('option_title');
							
					if(isset($post_option)&&$post_option!=='')
						$title = $title . ': '.$post_option;
						
					if ($degree === 'minor' || $degree === 'Minor')
						$title = $degree.' in '.$title;
					else
						$title = $title.', '.$degree;
						
					echo $title;
				?>
			</a>
		<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
		</div>
	</div>
</div>



<?php get_footer(); ?>