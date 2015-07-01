		<a href="#skipstuff" class="top-link hidden-xs" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
			<div id="to_top">
				<span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>Top
			</div>
		</a>
		<div id="footer">
			<div id="outside-footer" class="row">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 footpad clearfix">
							<div class="footbox">
								<p>View Catalog Archives, Degree Planning Guides and external resources here: </p>
								<div class="btnbox">
									<span class="redbtn"><a href="<?php echo site_url('/resources'); ?>">Resources</a></span>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 footpad clearfix">
							<div class="footbox">
								<p>Was this site helpful to you? <br>Let us know:</p>
								<div class="btnbox">
									<form action="<?php echo site_url('/feedback'); ?>" method="get">
									<input type="hidden" name="referer-url" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
									<input class="redbtn" type="submit" value="Feedback" />
									</form>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 footpad clearfix">
							<div class="footbox noborder">
								<span class="bold">California State University, Northridge</span>
								<span>18111 Nordhoff Street, Northridge, CA 91330</span>
								<span>Phone: (818) 677-1200 | <a class="red" target="_blank" href="http://www.csun.edu/contact/">Contact Us</a></span>
								<span class="bold"><a class="red" target="_blank" href="http://www.csun.edu">www.csun.edu</a></span>
							</div>
						</div>
					</div>	<!-- end row -->
				</div> <!-- end container -->
			</div>
			<div class="row linksrow">
				<div class="container">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 footerlinks">
						<a target="_blank" href="http://www.csun.edu/emergency/">Emergency Information</a>
						<a target="_blank" href="http://www.calstate.edu/">California State University</a>
						<a target="_blank" href="http://www.csun.edu/sites/default/files/900-12.pdf">Terms and Conditions for Use (pdf)</a>
						<a target="_blank" href="http://www.csun.edu/afvp/university-policies-procedures ">University Policies &amp; Procedures</a>
						<a target="_blank" href="http://www.csun.edu/it/document-viewers" title="Download a pdf reader here">Document Reader</a>
					</div>
				</div>
			</div>
			<div id="lastrow">
			</div>
		</div>
		</div> <!-- overflow-wrap end -->
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/custom.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/respond.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/respond.matchmedia.addListener.min.js"></script>
		<script type="text/javascript" src="//use.typekit.net/gfb2mjm.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
		<?php wp_footer();?>
	</body>
</html>