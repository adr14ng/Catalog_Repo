<?php 
/**
 * Template Name: Group Single View
 */ 
 
$terms = get_the_terms($post->ID, 'group_type');

foreach($terms as $term)
{
	$title = $term->name;
	break;
}

$page = get_posts( array(
	'group_type' => $term->slug,
	'post_type' => 'page',
	)
);

$link = get_permalink($page[0]->ID);
 
get_header(); ?>



<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<a class="dept-title-small" href="<?php echo $link; ?>"><?php echo $title; ?></a>
					<h1 class="prog-title"><?php the_title(); ?></h1>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="section-content">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; endif; ?>
						</div>
					</div>
				</div>
			</div><!--/end col -->
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="section-content">
					<?php 
						$subject_line = "CSUN Catalog - ".$deptdesc;
						$subject_line = str_replace(' ', '%20', $subject_line);
						$body = 'Permalink : '.get_the_permalink();
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
				<div class="section-content contact">
					<span class="section-title"><span><h2>Contact</h2></span></span> 
					<?php the_field('contact'); ?>
				</div>
			</div> <!--/end col -->
		</div><!--/end row -->
	</div><!--/end wrap -->
</div><!--/end main-section -->


<?php get_footer(); ?>