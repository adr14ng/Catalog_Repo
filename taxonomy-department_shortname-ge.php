<?php 
/**
 * Template Name: General Education Courses Template
 */ 



get_header(); ?>



<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<a class="dept-title-small" href="<?php bloginfo( 'url' ); ?>/general-education/">General Education</a>
					<h1 class="prog-title"><?php the_title(); ?></h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="main-section" class = "main">
	<div class="container" id="wrap">
		<div class="row small-marg-top small-marg-bottom">
			<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 left-sidebar ">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 side-nav-col clearfix noborder">
					<?php 
					$args = array(
							'theme_location' => 'ge-menu',
							'container' => false,
							'menu_class' => 'side-nav',
							'fallback_cb' => false,
							
						);
					
					wp_nav_menu( $args ); 
					?>
				</div>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
				<?php if(have_posts()): while (have_posts()) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; endif; ?>
				<div class="panel-group" id="accordion">
				<?php 
				$terms = get_terms('general_education');

				foreach($terms as $term) :

					if($term->slug !== 'ic' && $term->slug !== 'ud'): 
					
						$query_policies = new WP_Query(array('post_type' => 'courses', 'orderby' => 'title', 'order' => 'ASC',  'general_education' => $term->slug, 'posts_per_page' => 1000,));
						$count = $query_policies->post_count;
					?>
						<div class="panel panel-default">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $term->slug;?>" class="ge-collapse"  aria-expanded="false" aria-controls="collapse-<?php echo $term->slug; ?>">
								<div class="panel-heading" role="tab" id="heading-<?php echo $term->slug;?>">
									<h2 class="pseudo-h4 panel-title">
										<?php echo ($term->description).' ('.$count.')'; ?>
										<span class="glyphicon pull-right glyphicon-plus-sign"></span>
										<span class="glyphicon pull-right glyphicon-minus-sign"></span>
									</h2>
								</div>
							</a>
							<div id="collapse-<?php echo $term->slug; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-<?php echo $term->slug;?>">
								<div class="panel-body">

								<?php if($query_policies->have_posts()) : while($query_policies->have_posts()) : $query_policies->the_post(); ?>
								
									<p><a href="<?php the_permalink();?>"><?php the_title(); ?></a></p>

								<?php endwhile; endif; ?>
								</div>
							</div>
						</div>
				<?php endif; endforeach;?>
				<?php wp_reset_query(); ?>
				</div>
			</div>
		</div>
	</div>
</div>



<?php get_footer(); ?>