<?php
/*
* This is the page by clicking on any individual course and seeing it pop out to a new window.
*/
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

$semester_no_dash = strtok($semester,'-')." ".strtok('-');
$semester_no_dash2 = strtok($semester,'-')." ".strtok('-');

$semester_pretty = ucwords($semester_no_dash);
$semester2_pretty = ucwords($semester_no_dash2);
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
		<div id="inset-logo">
			<a href="http://www.csun.edu/">
				<img id="popup-logo" alt="California State University, Northridge" src="http://www.csun.edu/~catalog/catalog1516/catalog/wp-content/themes/catalogtheme/img/logo-320.png">
			</a>
		</div>
		<?php if(have_posts()): while (have_posts()) : the_post(); ?>
			<h1 class="popup-title"><?php the_title(); ?></h1>
			<div class="pad-box">
				<div id="inset-content" class="popup">
					<?php the_content(); ?>
					<div class="row">
						<?php if($single): ?>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<div class="section-content">
								<h3 class="pseudo-h6" id="course-header"><?php echo nl2br($semester_pretty." - "."<a target="."_blank"." href="."https://www.csun.edu/class-search".">Schedule of Classes</a>"."\n".$course_title_pretty, false); ?></h3>
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
								<h3 class="pseudo-h6" id="activ-header"><?php echo nl2br($semester_pretty." - "."<a target="."_blank"." href="."https://www.csun.edu/class-search".">Schedule of Classes</a>"."\n".$activ_title_pretty, false); ?></h3>
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
								<h3 class="pseudo-h6" id="course2-header"><?php echo $course_title_pretty." -- ".$semester2_pretty; ?></h3>
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
								<h3 class="pseudo-h6" id="activ2-header"><?php echo $activ_title_pretty." -- ".$semester2_pretty; ?></h3>
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
				</div>
			</div>
		<?php endwhile; else: ?>
			<p><?php _e('Sorry, no GE courses in this section.'); ?></p>
		<?php endif; ?>
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


				$.ajax({
					url: "http://curriculum.ptg.csun.edu/terms/"+semester+"/classes/"+course,
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

						$("#"+name+"-info").append(html);
						$("#"+name+"-header").html(title);
					}
				});
			}
		</script>
		<script type="text/javascript" src="//use.typekit.net/gfb2mjm.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	</body>
</html>
