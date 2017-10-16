<?php 
/**
 * Template Name: Faculty Archive Template
 *
 * There are three different pages within this template
 * The Department style page, the all emeriti page, 
 * and the all current page
 */ 

$dept = get_query_var( 'department_shortname' );
$deptterm = get_term_by( 'slug', $dept, 'department_shortname' );
$deptdesc = $deptterm->description;

//Don't display department tabs on faculty/administrator pages
if($dept === "faculty" || $dept === "admin")
	$noDpt = true;
	
//count emeritus faculty
$count = 0;

get_header(); ?>

<?php if (!($dept === 'emeriti' || $dept === '')): ?>

	<div class="row" id="subnav-wrap">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="section-content page-title-section">
						<?php if($noDpt) : ?>
						<a class="dept-title-small" href="<?php echo site_url('/faculty/');?>">Faculty and Administrators</a>
						<h1 class="prog-title"><?php echo $deptdesc; ?></h1>
						<?php else: ?>
						<span class="dept-title-small">Faculty and Administrators</span>
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
				<div class="section-content">
					<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
					<span class="section-title"><span><h2>Current Faculty</h2></span></span>
					<?php if(have_posts()): while (have_posts()) : the_post(); ?>

						<?php if( strpos(get_the_term_list(  $post->ID, 'department_shortname', '', ', '), 'Emeriti') === FALSE): ?>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">
								<a class="csun-subhead" href="<?php the_csun_permalink(); ?>"><h3 class="csun-subhead"><?php the_title(); ?></h3></a>
								<?php the_excerpt(); ?>
							</div>
						<?php endif; ?>

					<?php endwhile; else: ?>
					
						<p><?php _e('Refer to the Overview tab for faculty associated with '.$deptdesc.'.'); ?></p>
						
					<?php endif; ?>

						<br /><br /><br />
						<span class="section-title" id="emeriti" ><span><h2>Emeriti</h2></span></span>

					<?php if(have_posts()): while (have_posts()) : the_post(); ?>

						<?php if( strpos(get_the_term_list(  $post->ID, 'department_shortname', '', ', '), 'Emeriti') !== FALSE): 
							$count++;
						?>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">
								<a class="csun-subhead" href="<?php the_permalink(); ?>"><h3 class="csun-subhead"><?php the_title(); ?></h3></a>
								<?php the_excerpt(); ?>
							</div>
						<?php endif; ?>

					<?php endwhile; endif; ?>
					<?php if($count === 0) : ?>

						<?php
							echo '
								<style type="text/css">
									#emeriti{
										display:none;
									}
								</style>
							';
						?>
					<?php endif;?>

					</div>
					<?php if(!$noDpt) : ?>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 right-sidebar ">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix noborder">
							<span class="section-title"><span><h2>Contact</h2></span></span>
								<?php echo get_csun_contact($dept); ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

<?php elseif ($dept === 'emeriti'): ?>

	<div class="row" id="subnav-wrap">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="section-content page-title-section">
						<span class="dept-title-small">Faculty and Administrators</span>
						<h1 class="prog-title">Emeritus Faculty</h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="main-section"  class = "main">
		<div class="container" id="wrap">
			<div class="row">
				<div class="section-content">
					<div id="abc_nav" data-spy="affix" data-offset-top="440" data-offset-bottom="10" class = "hidden-xs col-sm-3 col-md-3 col-lg-3">
						<?php foreach (range('A', 'Z') as $char) : ?>
							<a href="#<?php echo 'index-'.$char; ?>">
								<span class="btn btn-primary btn-sm"><?php echo $char; ?></span>
							</a>
						<?php endforeach; ?>
					</div>
					<div class = "col-sm-3 col-md-3 col-lg-3"></div>
					<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
					<?php $curr_letter = '';
					 if(have_posts()): while (have_posts()) : the_post(); 
						$this_letter = strtoupper(substr($post->post_title,0,1));
						
						if($this_letter != $curr_letter) {
							echo '<span class="section-title abc_title"><span><h2 id="index-'.$this_letter.'">'.$this_letter.'</h2></span></span>';
							$curr_letter = $this_letter;
						}
					 
					 ?>

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">
							<a class="csun-subhead" href="<?php the_permalink(); ?>"><h3 class="csun-subhead"><?php the_title(); ?></h3></a>
							<?php the_excerpt(); ?>
						</div>

					<?php endwhile; else: ?>
					
						<p><?php _e('Sorry, no emeriti faculty found.'); ?></p>
						
					<?php endif; ?>

					</div>
				</div>
			</div>
		</div>
	</div>

<?php else: ?>

	<div class="row" id="subnav-wrap">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="section-content page-title-section">
						<span class="dept-title-small">Faculty and Administrators</span>
						<h1 class="prog-title">Faculty and Administration</h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="main-section"  class = "main">
		<div class="container" id="wrap">
			<div class="row">
				<div class="section-content">
					<div id="abc_nav" data-spy="affix" data-offset-top="440" data-offset-bottom="10" class = "hidden-xs col-sm-3 col-md-3 col-lg-3">
						<?php foreach (range('A', 'Z') as $char) : ?>
							<a href="#<?php echo 'index-'.$char; ?>">
								<span class="btn btn-primary btn-sm"><?php echo $char; ?></span>
							</a>
						<?php endforeach; ?>
					</div>
					<div class = "col-sm-3 col-md-3 col-lg-3"></div>
					<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">

					<?php $curr_letter = '';
					if(have_posts()): while (have_posts()) : the_post(); ?>
					
						<?php if( strpos(get_the_term_list(  $post->ID, 'department_shortname', '', ', '), 'Emeriti') === FALSE): 
							$this_letter = strtoupper(substr($post->post_title,0,1));
							
							if($this_letter != $curr_letter) {
								echo '<span class="section-title abc_title"><span><h2 id="index-'.$this_letter.'">'.$this_letter.'</h2></span></span>';
								$curr_letter = $this_letter;
							}
						?>

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix">
								<a class="csun-subhead" href="<?php the_permalink(); ?>"><h3 class="csun-subhead"><?php the_title(); ?></h3></a>
								<?php the_excerpt(); ?>
							</div>
						
						<?php endif; ?>

					<?php endwhile; else: ?>
					
						<p><?php _e('Sorry, no faculty found.'); ?></p>
						
					<?php endif; ?>

					</div>
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>

<?php get_footer(); ?>
