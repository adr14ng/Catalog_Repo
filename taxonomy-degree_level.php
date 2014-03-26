<?php

/*Template Name: Degree Level Template
 */ 



 get_header(); 

$level = get_query_var( 'degree_level' );
?>

<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<a class="dept-title-small" href="<?php echo get_csun_archive('programs', $dept); ?>">Programs</a>
					<a href="<?php echo the_permalink(); ?>"><h1 class="prog-title"><?php echo ucwords($level); ?></h1></a>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="main-section">
	<div class="container" id="wrap">
		<div class="dept-container content">
		<?php if(have_posts()): while (have_posts()) : the_post(); ?>
			<div class="dept-item ">
				<a href="<?php the_permalink(); ?>"><?php 
					$degree = get_field('degree_type'); 
					$title = get_the_title(); 
						
					if ($degree === 'minor' || $degree === 'Minor')
						$title = $degree.' in '.$title;
					else
						$title = $degree.', '.$title;
						
					echo $title;
					
					$post_option=get_field('option_title');
							
					if(isset($post_option)&&$post_option!=='')
						echo ': '.$post_option;
				?></a>
			</div>
		<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
		</div>
	</div>
</div>



<?php get_footer(); ?>