<?php 

/**
 * Template Name: Courses Single View
 */ 



$dept = get_query_var( 'department_shortname' );
$deptterm = get_term_by( 'slug', $dept, 'department_shortname' );
$deptdesc = $deptterm->description;

$single=$double=false;

preg_match("/([A-Z]{2,4}) ([0-9]{3})(.{0,8})\. (.)* \(([0-9]|[0-9]\/[0-9]|[0-9](-[0-9])*)\)/", get_the_title() , $course_info);

if($course_info[3]== ""){		//Basic Class
	$course_title = strtolower($course_info[1]).'-'.$course_info[2];
	$single = true;
}
elseif(strpos($course_info[3], '/') !== false){		//Class with activity
	$double=$single= true;
	
	//In case of classes like PHYS220A and PHYS220AL
	$suffix = explode('/', $course_info[3]);
	
	$course_title = strtolower($course_info[1]).'-'.$course_info[2].$suffix[0];
	$activity_title = $course_title.$suffix[1];
}
elseif(strpos($course_info[3], '-') === false){	//All other classes that AREN'T A-F types
	$single = true;
	$course_title = strtolower($course_info[1]).'-'.$course_info[2].$course_info[3];
}
	

get_header(); ?>

<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<a class="dept-title-small" href="<?php echo get_csun_archive('courses', $dept); ?>">Courses</a>
					<a href="<?php echo get_csun_archive('departments', $dept); ?>"><h1 class="prog-title"><?php echo $deptdesc; ?></h1></a>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div id="catalog-subnav">
					<ul class="clearfix">
						<li><a href="<?php echo get_csun_archive('departments', $dept); ?>">Overview</a></li>
						<li><a href="<?php echo get_csun_archive('programs', $dept); ?>">Programs</a></li>
						<li><a href="<?php echo get_csun_archive('faculty', $dept); ?>">Faculty</a></li>
						<li class="active"><a href="<?php echo get_csun_archive('courses', $dept); ?>">Courses</a><div class="arrow-wrap"><span class="subnav-arrow"></span></div></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-title-wrap">
				<div class="row">
					<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
						<h2 class="inner-title dark"><span class="red">Course:</span> <?php the_title(); ?></h2>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
						<?php 
							$subject_line = "CSUN Catalog - ".get_the_title();
							$subject_line = str_replace(' ', '%20', $subject_line);
							$body = 'Permalink : '.get_csun_permalink();
							$body = str_replace(' ', '%20', $body);
						?>
						<ul id="share-icons">
							<!-- <li><?php pdf_all_button(); ?></li> -->
							<li>
								<a class="no-line" title="Email this page" 
									href='mailto:?subject=<?php echo $subject_line ?>&amp;body=<?php echo $body; ?>' >
									<span class="stLarge glyphicon glyphicon glyphicon-envelope share-icon"></span>
									<span class="screen-reader-text">email</span>
								</a>
							</li>
							<li><a class="no-line" href="javascript:window.print()" title="Print this page.">
									<span class="glyphicon glyphicon-print share-icon"></span>
									<span class="screen-reader-text">print</span>
								</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div id="breadcrumbs-wrap" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<?php echo the_breadcrumb(); ?>
					</div>
				</div>
			</div>
			<div class="pad-box">
				<div id="inset-content">
				<?php if(have_posts()): while (have_posts()) : the_post(); ?>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="section-content">
								<?php the_content();?>
							</div>
							
							<?php if($single): ?>
							<div class="section-content">
								<h3 class="sm-h3" id="course-header"></h3>
								<table class="csun-table" id="class-info" summary="Class sections"><tbody>
									<tr><th>Class Number</th><th>Location</th><th>Day</th><th>Time</th><tr>
								</tbody></table>
							</div>
								
			
								
								<?php //echo $course_title; ?>
								<script>
									/**
									 * Course Information Request
									 *
									 * Requests information in JSON format from OMAR via AJAX 
									 *
									 * Formats and displays the information in a table
									 */
									(function($) { 
									   $(document).ready(function(){
										  $.ajax({
											   url: "http://curriculum.ptg.csun.edu/terms/fall-2014/classes/<?php echo $course_title; ?>",
											   type: 'get',
											   cache: 'false',
											   dataType: 'json',
											   success: function(data_back){
													var html = "";
													var title;
													var data = data_back.classes;
													var meeting;
													var instructors;
													
													if(data.length<1){
														html = '<tr><td colspan="4">No sections offered this semester</td></tr>'
													}
													else{
														title = data[0].subject+' '+data[0].catalog_number+' - '+data[0].title+' -- '+data[0].term;
														
														// run through the data and add it to the final markup
														 $(data).each(function(){
															if( this.section_number != null) {
																meeting = this.meetings;
																if(meeting[0] != null) {
																	var start_hour;
																	var end_hour;
																	var start_let = 'am';
																	var end_let = 'am';
																
																	var day = meeting[0].days;
																	var start = meeting[0].start_time;
																	var end = meeting[0].end_time;
																	var location = meeting[0].location;
																	
																	day = day.replace("A", "-");
																	day = day.replace("M", "Mo");
																	day = day.replace("T", "Tu");
																	day = day.replace("W", "We");
																	day = day.replace("R", "Th");
																	day = day.replace("F", "Fr");
																	day = day.replace("S", "Sa");
																	
																	start_hour = parseInt(start.slice(0,2));
																	end_hour = parseInt(end.slice(0,2));
																	
																	if(start_hour > 11)
																		start_let = 'pm';
																	
																	if(end_hour > 11)
																		end_let = 'pm'
																		
																	if(start_hour > 12)
																		start_hour = start_hour - 12;
																		
																	if(end_hour > 12)
																		end_hour = end_hour - 12;
																	
																	if(start_hour !== 0) {
																		start = start_hour+':'+start.slice(2,4)+start_let;
																		end = end_hour+':'+end.slice(2,4)+end_let;
																	}
																	else
																		start = end = '';
																
																
																	// this is not processing
																	html += '<tr><td>'+this.class_number+'</td><td>'+location+'</td><td>'+day+'</td><td>'+start+'-'+end+'</td><tr>';
																}
															}
														 });
													}
													
													 $("#class-info").append(html);
													 $("#course-header").html(title);
												}
											});
											
						
									   });
									})(jQuery);
								</script>	
						<?php endif; ?>
						<?php if($double): ?>
							<div class="section-content">
								<h3 class="sm-h3" id="activ-header"></h3>
								<table class="csun-table" id="activ-info" summary="Class Activity sections"><tbody>
									<tr><th>Class Number</th><th>Location</th><th>Day</th><th>Time</th><tr>
								</tbody></table>
							</div>
								
								<script>
									/**
									 * Course Information Request
									 *
									 * Requests information in JSON format from OMAR via AJAX 
									 *
									 * Formats and displays the information in a table
									 */
									(function($) { 
									   $(document).ready(function(){
										  $.ajax({
											   url: "http://curriculum.ptg.csun.edu/terms/fall-2014/classes/<?php echo $activity_title; ?>",
											   type: 'get',
											   cache: 'false',
											   dataType: 'json',
											   success: function(data_back){
													var html = "";
													var title;
													var data = data_back.classes;
													var meeting;
													var instructors;
													
													if(data.length<1){
														html = '<tr><td colspan="4">No sections offered this semester</td></tr>'
													}
													else{
														title = data[0].subject+' '+data[0].catalog_number+' - '+data[0].title+' -- '+data[0].term;
														
														// run through the data and add it to the final markup
														 $(data).each(function(){
															if( this.section_number != null) {
																meeting = this.meetings;
																if(meeting[0] != null) {
																	var start_hour;
																	var end_hour;
																	var start_let = 'am';
																	var end_let = 'am';
																	
																	var day = meeting[0].days;
																	var start = meeting[0].start_time;
																	var end = meeting[0].end_time;
																	var location = meeting[0].location;
																	
																	day = day.replace("A", "-");
																	day = day.replace("M", "Mo");
																	day = day.replace("T", "Tu");
																	day = day.replace("W", "We");
																	day = day.replace("R", "Th");
																	day = day.replace("F", "Fr");
																	day = day.replace("S", "Sa");
																	
																	start_hour = parseInt(start.slice(0,2));
																	end_hour = parseInt(end.slice(0,2));
																	
																	if(start_hour > 11)
																		start_let = 'pm';
																	
																	if(end_hour > 11)
																		end_let = 'pm'
																		
																	if(start_hour > 12)
																		start_hour = start_hour - 12;
																		
																	if(end_hour > 12)
																		end_hour = end_hour - 12;
																	
																	if(start_hour !== 0) {
																		start = start_hour+':'+start.slice(2,4)+start_let;
																		end = end_hour+':'+end.slice(2,4)+end_let;
																	}
																	else
																		start = end = '';
																
																
																	// this is not processing
																	html += '<tr><td>'+this.class_number+'</td><td>'+location+'</td><td>'+day+'</td><td>'+start+'-'+end+'</td><tr>';
																}
															}
														 });
													}
													
													 $("#activ-info").append(html);
													 $("#activ-header").html(title);
												}
											});
											
						
									   });
									})(jQuery);
								</script>	

						<?php endif; ?>
						</div>
					</div>
				<?php endwhile; endif; ?>
				</div> <!-- end inset-content -->
			</div> <!-- end pad-box -->
		</div> <!-- end row -->
	</div> <!-- end wrap -->
</div> <!-- end main-section -->


<?php get_footer(); ?>