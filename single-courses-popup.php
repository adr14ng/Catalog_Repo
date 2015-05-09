<?php

?>
<!DOCTYPE html>
<html lang="en" class="popup">
	<head>
	  <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
	  <meta charset="utf-8"/>
	  <meta name="msvalidate.01" content="F5D407E70DCB74B1DEE5C3274C2EBCF7" />
	  <title><?php the_title(); ?></title>
	  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-1.11.1.min.js"></script>
	  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/bootstrap.min.js"></script>
	  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.columnizer.js"></script>
	  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/custom.js"></script>
	  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css">
	  <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">
	  <?php wp_head();?>
	</head>
	<body>
		<?php if(have_posts()): while (have_posts()) : the_post(); ?>
			<h1 class="popup-title"><?php the_title(); ?></h1>
			<div class="pad-box">
				<div id="inset-content" class="popup">
					<?php the_content(); ?>
				</div>
			</div>
		<?php endwhile; else: ?>
			<p><?php _e('Sorry, no GE courses in this section.'); ?></p>
		<?php endif; ?>
		<script type="text/javascript" src="//use.typekit.net/gfb2mjm.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	</body>
</html>