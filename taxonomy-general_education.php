<?php

$ge = get_query_var( 'general_education' );
$terms = explode('+', $ge);
if($terms[0] !== 't1,t2,t3,t4' )
{
	$geterm = get_term_by( 'slug', $terms[0], 'general_education' );
	$gedesc = $geterm->description;
}
else
{
	$gedesc = 'Title 5';
}

if(isset($terms[1]) && $terms[1] === 'ud')
{
	$title = $gedesc.' - Upper Division Courses';
}
else
{
	$title = $gedesc.' - Courses';
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	  <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
	  <meta charset="utf-8"/>
	  <meta name="msvalidate.01" content="F5D407E70DCB74B1DEE5C3274C2EBCF7" />
	  <title><?php echo $title; ?></title>
	  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css">
	  <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">
	  <?php wp_head();?>
	</head>
	<body>
		<div class="section-content page-title-section">
			<h1 class="prog-title"><?php echo $title; ?></h1>
		</div>
			<div class="pad-box">
				<div id="inset-content" class="popup">
				<?php if(have_posts()): while (have_posts()) : the_post(); ?>
					<p><a href="<?php the_permalink();?>" target="_blank"><?php the_title(); ?></a></p>
				<?php endwhile; else: ?>
					<p><?php _e('Sorry, no GE courses in this section.'); ?></p>
				<?php endif; ?>
				</div>
			</div>
	</body>
</html>