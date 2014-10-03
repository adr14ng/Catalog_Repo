<!DOCTYPE html>
<html lang="en">
	<head>
	  <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
	  <meta charset="utf-8"/>
	  <meta name="msvalidate.01" content="F5D407E70DCB74B1DEE5C3274C2EBCF7" />
	  <title>
		<?php csun_title_text(); ?>
	  </title>
	  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css">
	  <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">
	  <?php if(is_singular('plans') || is_singular('staract')) : ?>
		<link rel="stylesheet" type="text/css" media="print" href="<?php bloginfo('template_directory'); ?>/plans-print.css">
	  <?php else: ?>
		<link rel="stylesheet" type="text/css" media="print" href="<?php bloginfo('template_directory'); ?>/print.css">
	  <?php endif; ?>
	  <?php if(is_singular('departments')): ?>
		<link rel="canonical" href="<?php the_canonical_url(); ?>">
	  <?php endif; ?>
	  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-1.10.2.min.js"></script>
	  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/bootstrap.min.js"></script>
	  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.columnizer.js"></script>
	  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/custom.js"></script>
	  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/respond.min.js"></script>
	  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/respond.matchmedia.addListener.min.js"></script>
	  <script type="text/javascript" src="//use.typekit.net/gfb2mjm.js"></script>
	  <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	  <script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-33750383-3', 'csun.edu');
		ga('require', 'displayfeatures');
		ga('send', 'pageview');

	  </script>
	  
		<?php wp_head();?>
		
	</head>


	<body>
		<div id="overflow-wrap">
			<div id="fixbar">
				<div id="mininav">
				
					<div class="iconblock">
						<a><span id="menuicon" class="glyphicon glyphicon-align-justify"></span>
						</a>
					</div> <!-- end menu iconblock -->
					
					<div id="neglogo">
						<a href="http://www.csun.edu/">
							<img alt="California State University, Northridge" src="<?php bloginfo('template_directory'); ?>/img/negative-logo.png">
						</a> 
					</div> <!-- end neglogo -->
					
					<div class="iconblock">
						<a ><span id="searchicon" class="glyphicon glyphicon-search right"></span></a>
					</div><!-- end search iconblock -->
					
				</div> <!-- end mininav -->
				
				<div class="container" id="headerbar">
					<div class="row">
					
						<div class="col-sm-4 col-lg-4 headerbar-logo">
							<a href="http://www.csun.edu/"> 
								<img alt="California State University, Northridge" src="<?php bloginfo('template_directory'); ?>/img/logo.png" id="logo">
							</a> 
						</div>
						
						<div class="col-xs-12 col-sm-8 col-lg-8">
						
							<div class="row" id="quicklinks-lg">
								<ul class="right">
									<li ><a href="#skipstuff">Skip Nav</a></li>
									<li ><a href="http://www.csun.edu/universaldesigncenter">Accessibility</a></li>
									<li ><a href="http://www.csun.edu/calendar/">Calendar</a></li>
									<li ><a href="https://www.csun.edu/peoplefinder/">Directory</a></li>
									<li ><a href="http://www.csun.edu/atoz/">A to Z</a></li>
									<li ><a href="https://www.csun.edu/webmail/">Webmail</a></li>
								</ul>
							</div>
							
							<div id ="search-div" class="hideme">
								<form class="navbar-form search-form clearfix" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
									<label for="s">Search Catalog:</label>
									<div id="csunsearch" class="input-group ">
										<input type="text" class="form-control" placeholder="Search Catalog" name="s" id="s">
										<div class="input-group-btn">
											<button id="searchsubmit" class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span> Search</button>
										</div>
									</div>
								</form>
							</div>
							
						</div>  <!-- end collumn -->
					</div>   <!-- end row -->
				</div> <!-- end container -->
				<div id="csunnav" class="hideme">
					<div class="container clearfix">
					<?php
						$defaults = array(
							'theme_location'  => '',
							'menu'            => '',
							'container'       => 'div',
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => 'menu',
							'menu_id'         => '',
							'echo'            => true,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'           => 0,
							'walker'          => ''
						);
						wp_nav_menu( $defaults );
					?>
					</div>
				</div> <!-- end csunnav -->
			</div> <!-- end fixbar -->

			<!-- Banner -->

			<?php if ( is_front_page() ) : ?>

				<div class="row" id="full-banner">
					<div class="container hidden-xs">
						<img src="<?php echo bloginfo('template_directory');?>/img/catalog_banner.jpg" class="img-responsive " alt="UNIVERSITY CATALOG: 2014-2015">
						
					</div>
					<img src="<?php echo bloginfo('template_directory');?>/img/mobile_main.jpg" class="hidden-md hidden-lg hidden-sm" alt="UNIVERSITY CATALOG: 2014-2015">
				</div>

			<?php else : ?>

				<div class="row" id="full-banner-inner">
					<div class="container hidden-xs">
						<img src="<?php echo bloginfo('template_directory');?>/img/catalog_banner_inside.jpg" class="img-responsive" alt="UNIVERSITY CATALOG: 2014-2015">				
					</div>

					<img src="<?php echo bloginfo('template_directory');?>/img/mobile_main.jpg" class="hidden-md hidden-lg hidden-sm" alt="UNIVERSITY CATALOG: 2014-2015">

				</div>

			<?php endif; ?>
			
			<div id="skipstuff"></div>