<?php get_header(); 

$level = get_query_var( 'degree_level' );
?>


<div class="container" id="wrap">

<div class="row">
	<div class="mainbanner">
		<img src="<?php bloginfo('template_directory'); ?>/img/shatter_small.jpg">
	</div>

	<!-- <div class=" container section-breadcrumb clearfix">
	</div> -->
</div>

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

<?php get_footer(); ?>