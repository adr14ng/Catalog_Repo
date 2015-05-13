<?php 
/**
 * Template Name: 404 Page
 */ 

get_header(); ?>

<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-title-wrap">
				<h1 class="inner-title dark pseudo-h2">Page Not Found</h1>
			</div>

			<div class="pad-box">
				<div id="inset-content">
					<p>The document you have requested cannot be located.</p>
					<p>To help you find the information use one of the following:</p>
					<ol>
						<li>Return to the <a href="<?php echo site_url(); ?>"><strong>Home Page</strong></a>.</li>
						<li>Use your <strong><a href="javascript:history.go(-1)">Back</a></strong> button on the browser and return to the previous page. Another link in the same section may get you to the information.</li>
						<li><a href="<?php echo site_url('/feedback/?referer-url=').urlencode($_SERVER['REQUEST_URI']); ?>"><strong>Contact Us</strong></a></li>
					</ol>
				</div><!-- end inset-content -->
			</div> 
		</div>
	</div>
</div>















	













<?php get_footer(); ?>