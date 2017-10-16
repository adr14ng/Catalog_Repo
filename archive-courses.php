<?php 

/**
 * Template Name: Courses Archive Template
 */ 

$dept = get_query_var( 'department_shortname' );
$deptterm = get_term_by( 'slug', $dept, 'department_shortname' );
$deptdesc = $deptterm->description;

get_header(); ?>

<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<span class="dept-title-small">Courses</span>
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
			<div class="section-content">
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
				<span class="section-title"><span><h2>Courses</h2></span></span>
				<?php if(have_posts()): while (have_posts()) : the_post(); ?>
				
					<?php //get which course pre fixes exist 
						$match = preg_match("/([A-Z]{2,4}) ([0-9]){3}(.{0,8})\./", get_the_title() , $matches);
						if($match === 1)
						{
							$prefix = $matches[1];
						}
					?>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix <?php echo $prefix; ?>">
						<a class="csun-subhead" href="<?php the_permalink(); ?>"><h3 class="csun-subhead"><?php the_title(); ?></h3></a>
						<?php the_excerpt(); ?>
					</div>
					<?php $types[$prefix] = $prefix; ?>
					
				<?php endwhile; else: ?>
				
					<p><?php _e('Refer to the Programs tab for courses associated with '.$deptdesc.'.'); ?></p>
					
				<?php endif; ?>
				</div>
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 left-sidebar ">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix noborder">
						<span class="section-title"><span><h2>Contact</h2></span></span>
						<?php echo get_csun_contact($dept); ?>
					</div>
					<?php if(count($types) > 1) : ?>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 inner-item clearfix noborder">
						<span class="section-title"><span><h2>Filter</h2></span></span>
						<ul class="checkbox-list">
						<?php foreach($types as $type) : ?>
						<li>
							<input type="checkbox" class="filter" name="<?php echo $type; ?>" id="<?php echo $type; ?>"/>
							<label for="<?php echo $type; ?>"><?php echo strtoupper($type); ?></label>
						</li>
						<?php endforeach; ?>
						</ul>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

	</div>
</div>

<?php get_footer(); ?>