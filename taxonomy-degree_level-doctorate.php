<?php get_header(); 

$level = get_query_var( 'degree_level' );
?>

<div class="row" id="full-banner-inner">
	<div class="banner-overlay">
		<div class="container">
			<h1 class="banner-title-inner"><span class="red">CSUN</span> UNIVERSITY CATALOG <span class="banner-title-small">2014-2015</span></h1>
		</div>
		
	</div>
</div>


<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="section-content page-title-section">
			<!-- <a class="dept-title-small" href="<?php the_permalink(); ?>">Programs</a> -->
				<a href="<?php echo get_csun_archive('policies', $dept); ?>"><h1 class="prog-title"><span class="dark"><?php echo ucwords($level); ?></span></h1></a>

	</div>
	</div>
	</div>
	</div>

</div>


<div id="main-section">
<div class="container" id="wrap">
	<div class="content">
		<h2><?php echo ucwords($level).'s';?></h2>
	</div>

	<div class="dept-container content">
        <?php if(have_posts()): while (have_posts()) : the_post(); ?>
            <div class="dept-item ">
                <a href="<?php the_permalink(); ?>"><?php the_field('degree_type'); ?> in <?php the_title(); ?></a>
            </div>
        <?php endwhile; else: ?>

  			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

		<?php endif; ?>

	</div>


</div>
</div>



<?php get_footer(); ?>