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
<html lang="en" class="popup">
	<head>
	  <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
	  <meta charset="utf-8"/>
	  <meta name="msvalidate.01" content="F5D407E70DCB74B1DEE5C3274C2EBCF7" />
	  <title><?php echo $title; ?></title>
	  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-1.11.1.min.js"></script>
	  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/bootstrap.min.js"></script>
	  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.columnizer.js"></script>
	  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/custom.js"></script>
	  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css">
	  <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">
	  <?php wp_head();?>
	</head>
	<body>
		<div id="inset-logo">
			<a href="http://www.csun.edu/">
				<img id="popup-logo" alt="California State University, Northridge" src="http://www.csun.edu/~catalog/catalog1516/catalog/wp-content/themes/catalogtheme/img/logo-320.png">
			</a>
		</div>
		<h1 class="popup-title"><?php echo $title; ?></h1>
		<div class="pad-box">
			<div id="inset-content" class="popup">
			<?php if(have_posts()): while (have_posts()) : the_post(); ?>
				<h2><a id="link-<?php the_ID(); ?>" href="<?php the_permalink(); ?>" class="single-ge-handle"><?php the_title(); ?></a></h2>
				<div id="content-<?php the_ID(); ?>" class="collapse content single-ge-collapse">
					<?php the_content(); ?>
				</div>
			<?php endwhile; else: ?>
				<p><?php _e('Sorry, no GE courses in this section.'); ?></p>
			<?php endif; ?>
			</div>
		</div>
		<script type="text/javascript" src="//use.typekit.net/gfb2mjm.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	</body>
</html>