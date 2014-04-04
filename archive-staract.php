<?php /**

 * Template Name: Staract Archive View

 */ 

get_header(); ?>



<div class="row" id="subnav-wrap">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="section-content page-title-section">
					<span class="dept-title-small">Planning</span>
					<h1 class="prog-title">Staract</h1>
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
					<div class="span10">
					<?php if (have_posts()) : while (have_posts()) : the_post();?>
					
						<?php the_content(); ?>
						
					<?php endwhile; endif; ?>
					
						<?php 
						$years = get_terms( 'aca_year', array('orderby' => 'name', 'order' => 'DESC',) );
						$url = site_url('/planning/staract/');?>
							
						<div class="plan-grid"><ul>
							
						<?php foreach($years as $year) : 
							$query_plans = new WP_Query(array(
							'post_type' => 'staract', 
							'aca_year' => $year->slug,));
							
							if($query_plans->have_posts()) :?>
							
								<li><a href="<?php echo $url.$year->slug; ?>"><?php echo $year->slug; ?></a></li>
								
							<?php endif;?>
						<?php endforeach; ?>
						</ul></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php get_footer(); ?>