<?php 
/**
 * Template Name: Faculty Single View
 */ 

$dept = get_query_var( 'department_shortname' );

$deptterm = get_term_by( 'slug', $dept, 'department_shortname' );

$faculty_name = get_the_title();
$first_token  = strtok( $faculty_name , ',');
$second_token = strtok(',');

$new_faculty_name = ($second_token.' '.$first_token);

$email = get_field( 'individuals_email' );
$ind_email = strtok($email, '@');

if($dept === "faculty" || $dept === "admin")
	$noDpt = true;

$deptdesc = $deptterm->description;

$position = "Faculty: ";
$terms = get_the_term_list(  $post->ID, 'department_shortname', '', ', ');

if( strpos( $terms, 'Emeriti') !== FALSE)
	$position = "Emeritus ".$position;
	
if( strpos( $terms, 'Administration') !== FALSE) {
	$admin = true;
	$position = "Administrator: ";
}
	
if( strpos( $terms, 'Faculty') !== FALSE && $admin)
	$position = "Administrator and Faculty: ";

get_header(); ?>


<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
				<?php if($noDpt) : ?>
					<a class="dept-title-small" href="<?php echo site_url('/faculty/');?>">Faculty and Administrators</a>
					<a class="prog-title" href="<?php echo get_csun_archive('faculty', $dept); ?>"><h1 class="prog-title"><?php echo $deptdesc; ?></h1></a>
				<?php else: ?>
					<a class="dept-title-small" href="<?php echo get_csun_archive('faculty', $dept); ?>">Faculty and Administrators</a>
					<a class="prog-title" href="<?php echo get_csun_archive('departments', $dept); ?>"><h1 class="prog-title"><?php echo $deptdesc; ?></h1></a>
				<?php endif; ?>
				</div>
			</div>
			<?php if(!$noDpt) : ?>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div id="catalog-subnav">
					<ul class="clearfix">
						<li><a href="<?php echo get_csun_archive('departments', $dept); ?>">Overview</a></li>
						<li><a href="<?php echo get_csun_archive('programs', $dept); ?>">Programs</a></li>
						<li class="active"><a href="<?php echo get_csun_archive('faculty', $dept); ?>">Faculty</a><div class="arrow-wrap"><span class="subnav-arrow"></span></div></li>
						<li><a href="<?php echo get_csun_archive('courses', $dept); ?>">Courses</a></li>
					</ul>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-title-wrap">
				<h2 class="inner-title dark"><span class="red">
					<?php echo $position; ?> 
				</span><?php the_title(); ?></h2>
				<?php if(!$noDpt) : ?>
				<div class="row">
					<div id="breadcrumbs-wrap" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<?php echo the_breadcrumb(); ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
			<div class="pad-box">
				<div id="inset-content">
				
				<?php if(have_posts()): while (have_posts()) : the_post(); ?>
				
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="section-content">
								<?php the_content(); ?>
							</div>		
						</div>
					</div>
				
				<?php endwhile; else: ?>
					
					<p><?php _e('Sorry, no faculty matched your criteria.') ?></p>
					
				<?php endif; ?>
				
					<div class="section-content">
 							<?php if(!empty($email)): ?>
									<p>Contact information for <?php echo $new_faculty_name ?> can be found using the <a href="<?php echo ('http://www.csun.edu/faculty/profiles/'.$ind_email); ?>" target="_blank">Faculty Application</a>.</p>
								<?php else: ?>
									<p> Contact information can be found using the campus <a href="https://www.csun.edu/peoplefinder/"target="_blank">directory</a>. </p>
							<?php endif; ?>
					</div>
				
				</div> <!-- end inset-content -->
			</div> 
		</div>
	</div>
</div>





<?php get_footer(); ?>