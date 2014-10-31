<?php 
/**
 * Template Name: 404 Page
 */ 

get_header(); ?>

<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-title-wrap">
				<h2 class="inner-title dark">Page Not Found</h2>
			</div>

			<div class="pad-box">
				<div id="inset-content">
					<p>The document you have requested cannot be located.</p>
					<p>To help you find the information use one of the following:</p>
					<ol>
						<li>Return to the <a href="<?php echo site_url(); ?>"><strong>Home Page</strong></a>.</li>
						<li>Use your <strong><a href="javascript:history.go(-1)">Back</a></strong> button on the browser and return to the previous page. Another link in the same section may get you to the information.</li>
						<li><a href="<?php echo site_url('/feedback/'); ?>"><strong>Contact Us</strong></a></li>
					</ol>
					<?php if(strpos( $_SERVER["REQUEST_URI"],"comp") !== FALSE) : ?>
						<p>If you are computer science, here is the link to all the programs: 
							<a href="http://www.csun.edu/catalog/academics/comp/programs/" style="font: x-large bold;">Computer Science Programs</a>
						</p>
						<p>Or you can remove the extra "catalog" in the url to go to the exact page you were looking for.</p>
					<?php endif; ?>
				</div><!-- end inset-content -->
			</div> 
		</div>
	</div>
</div>















	













<?php get_footer(); ?>