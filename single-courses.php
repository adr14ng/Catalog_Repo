<?php

/**
 * Template Name: Courses Single View
 * This can be found by Clicking on any individual course Example : Comp 282 Advanced Data Structures
 */



$dept = get_query_var( 'department_shortname' );
$deptterm = get_term_by( 'slug', $dept, 'department_shortname' );
$deptdesc = $deptterm->description;

$single=$double=false;

$match = preg_match("/([A-Z]{2,4}) ([0-9]{3})(.{0,8})\. (.)* \(([0-9]|[0-9]\/[0-9]|[0-9](-[0-9])*)\)/", get_the_title() , $course_info);

if($match === 1 && (strpos($course_info[3], '-') === false)) {		//We found a match that isn't A-F
	if($course_info[3]== ""){		//Basic Class
		$course_title = strtolower($course_info[1]).'-'.$course_info[2];
		$course_title_pretty = $course_info[1].' '.$course_info[2];
		$single = true;
	}
	elseif(strpos($course_info[3], '/') !== false){		//Class with activity
		$double=$single= true;

		//In case of classes like PHYS220A and PHYS220AL
		$suffix = explode('/', $course_info[3]);

		$course_title = strtolower($course_info[1]).'-'.$course_info[2].$suffix[0];
		$course_title_pretty = $course_info[1].' '.$course_info[2].$suffix[0];
		if (strlen($suffix[0].$suffix[1]) <= 2){
			$activ_title = $course_title.$suffix[1];
			$activ_title_pretty = $course_title_pretty.$suffix[1];
		} else {
			$activ_title = strtolower($course_info[1]).'-'.$course_info[2].$suffix[1];
			$activ_title_pretty = $course_info[1].' '.$course_info[2].$suffix[1];
		}
	}
	else{	//All other classes that AREN'T A-F types
		$single = true;
		$course_title = strtolower($course_info[1]).'-'.$course_info[2].$course_info[3];
		$course_title_pretty = $course_info[1].' '.$course_info[2].$course_info[3];
	}
}

$option = get_option( 'main_dp_settings' );	//get our options
$semester = $option['course_semester'];
$semester2 = $option['course_semester2'];

$semester_pretty = ucwords($semester);
$semester2_pretty = ucwords($semester2);

get_header(); ?>

<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<a class="dept-title-small" href="<?php echo get_csun_archive('courses', $dept); ?>">Courses</a>
					<a class="prog-title" href="<?php echo get_csun_archive('departments', $dept); ?>"><h1 class="prog-title"><?php echo $deptdesc; ?></h1></a>
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
						</div>
					</div>
					<div class="row">
						<?php if($single): ?>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<div class="section-content">
								<h3 class="pseudo-h6" id="course-header"><?php echo $semester_pretty." - "."<a target="."_blank"." href="."https://www.csun.edu/class-search".">Schedule of Classes</a>"; ?></h3>
								<h3 class="pseudo-h6" id="course-header-2"><?php echo $course_title_pretty; ?></h3>
								<table class="csun-table" id="course-info" summary="Class sections"><tbody>
									<tr><th>Class Number</th><th>Location</th><th>Day</th><th>Time</th><tr>
								</tbody></table>
							</div>
							<script>
								(function($) {
								   $(document).ready(function(){
										get_course_info('course');
								   });
								})(jQuery);
							</script>
						</div>
						<?php endif; ?>
						<?php if($double): ?>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<div class="section-content">
								<h3 class="pseudo-h6" id="activ-header"><?php echo $semester_pretty." - "."<a target="."_blank"." href="."https://www.csun.edu/class-search".">Schedule of Classes</a>"; ?></h3>
								<h3 class="pseudo-h6" id="activ-header-2"><?php echo $activ_title_pretty; ?></h3>
								<table class="csun-table" id="activ-info" summary="Class Activity sections"><tbody>
									<tr><th>Class Number</th><th>Location</th><th>Day</th><th>Time</th><tr>
								</tbody></table>
							</div>
							<script>
								(function($) {
								   $(document).ready(function(){
										get_course_info('activ');
								   });
								})(jQuery);
							</script>
						</div>
						<?php endif; ?>
					</div>
					<?php if($semester2) : ?>
					<div class="row">
						<?php if($single): ?>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<div class="section-content">
								<h3 class="pseudo-h6" id="course2-header"><?php echo $semester2_pretty." - "."<a target="."_blank"." href="."https://www.csun.edu/class-search".">Schedule of Classes</a>"; ?></h3>
								<h3 class="pseudo-h6" id="course2-header-2"><?php echo $course_title_pretty; ?></h3>
								<table class="csun-table" id="course2-info" summary="Class sections"><tbody>
									<tr><th>Class Number</th><th>Location</th><th>Day</th><th>Time</th><tr>
								</tbody></table>
							</div>
							<script>
								(function($) {
								   $(document).ready(function(){
										get_course_info('course2');
								   });
								})(jQuery);
							</script>
						</div>
						<?php endif; ?>
						<?php if($double): ?>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<div class="section-content">
								<h3 class="pseudo-h6" id="activ2-header"><?php echo $semester2_pretty." - "."<a target="."_blank"." href="."https://www.csun.edu/class-search".">Schedule of Classes</a>"; ?></h3>
								<h3 class="pseudo-h6" id="activ2-header-2"><?php echo $activ_title_pretty; ?></h3>
								<table class="csun-table" id="activ2-info" summary="Class Activity sections"><tbody>
									<tr><th>Class Number</th><th>Location</th><th>Day</th><th>Time</th><tr>
								</tbody></table>
							</div>
							<script>
								(function($) {
								   $(document).ready(function(){
										get_course_info('activ2');
								   });
								})(jQuery);
							</script>
						</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				<?php endwhile; endif; ?>
				</div> <!-- end inset-content -->
			</div> <!-- end pad-box -->
		</div> <!-- end row -->
	</div> <!-- end wrap -->
</div> <!-- end main-section -->
<script>
	function get_course_info(name){
		var semester;
		var course;

		if(name == 'course')
		{
			course = "<?php echo $course_title; ?>";
			semester = "<?php echo $semester; ?>";
		}
		else if(name == 'activ')
		{
			course = "<?php echo $activ_title; ?>";
			semester = "<?php echo $semester; ?>";
		}
		else if(name == 'course2')
		{
			course = "<?php echo $course_title; ?>";
			semester = "<?php echo $semester2; ?>";
		}
		else if(name == 'activ2')
		{
			course = "<?php echo $activ_title; ?>";
			semester = "<?php echo $semester2; ?>";
		}


			var title2;
			var schedule_of_Classes = "Schedule of Classes";
			var schedule_link = schedule_of_Classes.link("https://www.csun.edu/class-search");


		$.ajax({
			url: "https://api.metalab.csun.edu/curriculum/terms/"+semester+"/classes/"+course,
			type: 'get',
			cache: 'false',
			dataType: 'json',
			success: function(data_back){
				var html = "";
				var title;
				var data = data_back.classes;
				var meeting;
				var instructors;


				if(data.length < 1){
					html = '<tr><td colspan="4">No sections offered this semester</td></tr>'
				}
				else{
					title = data[0].term+' - '+schedule_link;
					title2 = data[0].subject+' '+data[0].catalog_number+' - '+data[0].title;

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

				$("#"+name+"-info").append(html);
				$("#"+name+"-header").html(title);
				$("#"+name+"-header-2").html(title2);
			}
		});
	}
</script>

<?php get_footer(); ?>
